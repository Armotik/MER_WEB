<?php

namespace App\Service;


use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;

class AutoModerationService
{

    private array $blacklist = [];
    private string $badwordPath;

    public function __construct(private readonly ArticleRepository $articleRepository, string $badwordsPath)
    {
        $this->badwordPath = $badwordsPath;
    }


    /**
     * @param string $content
     * @return array [bool, httpCode]
     */
    public function isContentValid(string $content): array
    {
        if (empty($content) || strlen($content) < 5 || strlen($content) > 255) return [false, ResponseCode::INVALID_LENGTH];

        if (str_contains($content, '<script>')) return [false, ResponseCode::INVALID_CONTENT];

        if (empty($this->blacklist)) {

            $file = fopen($this->badwordPath, 'r');

            while (!feof($file)) {
                $this->blacklist[] = trim(fgets($file));
            }

            fclose($file);
        }

        foreach ($this->blacklist as $word) {
            if (stripos($content, $word) !== false) return [false, ResponseCode::INVALID_CONTENT];
        }

        return [true, ResponseCode::OK];
    }

    public function spamProtection(string $content): bool
    {
        // Spam protection
        $commentFrequencyLimit = 10;
        $commentFrequencyTimeLimit = 60; // 60 seconds

        // get 10 last comments
        $comments = $this->articleRepository->createQueryBuilder("a")
            ->innerJoin('a.comments', 'c')
            ->addSelect('c')
            ->orderBy('c.date', 'DESC')
            ->setMaxResults($commentFrequencyLimit)
            ->getQuery()
            ->getResult();

        if (count($comments) >= $commentFrequencyLimit) return false;

        // check if the comment is the same as the one posted less than 60 seconds ago

        $count = 0;

        foreach ($comments as $comment) {
            if ($comment->getContent() === $content) return false;

            if (time() - $comment->getDate()->getTimestamp() < $commentFrequencyTimeLimit) {
                $count++;
            }
        }

        if ($count >= $commentFrequencyLimit) return false;

        return true;
    }
}