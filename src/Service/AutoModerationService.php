<?php

namespace App\Service;


use App\Repository\ArticleRepository;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\Filesystem\Filesystem;

class AutoModerationService
{

    private array $blacklist = [];

    public function __construct(private readonly ArticleRepository $articleRepository, string $badwordsPath)
    {

        if (empty($badwordsPath)) return;

        $file = fopen($badwordsPath, 'r');

        while (!feof($file)) {
            $this->blacklist[] = trim(fgets($file));
        }

        fclose($file);

        //todo : error handling eof
    }

    public function isContentValid(string $content): bool
    {
        if (empty($content) || strlen($content) < 5 || strlen($content) > 255) return false;

        if (str_contains($content, '<script>')) return false;

        if (empty($this->blacklist)) return true;

        dd($this->blacklist);

        foreach ($this->blacklist as $word) {
            if (stripos($content, $word) !== false) return false;
        }

        return true;
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
            ->orderBy('c.createdAt', 'DESC')
            ->setMaxResults($commentFrequencyLimit)
            ->getQuery()
            ->getResult();

        if (count($comments) >= $commentFrequencyLimit) return false;

        // check if the comment is the same as the one posted less than 60 seconds ago

        $count = 0;

        foreach ($comments as $comment) {
            if ($comment->getContent() === $content) return false;

            if (time() - $comment->getCreatedAt()->getTimestamp() < $commentFrequencyTimeLimit) {
                $count++;
            }
        }

        if ($count >= $commentFrequencyLimit) return false;

        return true;
    }
}