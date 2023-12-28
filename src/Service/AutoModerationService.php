<?php

namespace App\Service;


use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;

class AutoModerationService
{

    private array $blacklist = [];
    private string $badwordPath;

    /**
     * AutoModerationService constructeur.
     * @param ArticleRepository $articleRepository Repository des articles
     * @param string $badwordsPath Chemin vers le fichier contenant les mots interdits
     */
    public function __construct(private readonly ArticleRepository $articleRepository, string $badwordsPath)
    {
        $this->badwordPath = $badwordsPath;
    }


    /**
     * Regarde si le contenu du commentaire est valide
     * @param string $content Contenu du commentaire
     * @return array [bool, ResponseCode] Si le contenu est valide ou non
     */
    public function isContentValid(string $content): array
    {
        if (empty($content) || strlen($content) < 5 || strlen($content) > 255) return [false, ResponseCode::INVALID_LENGTH];

        // todo
        if (stripos($content, '<script>') !== false) return [false, ResponseCode::INVALID_CONTENT];

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

    /**
     * Regarde si le commentaire est un spam
     * @param string $content Contenu du commentaire
     * @return bool Si le commentaire est un spam ou non
     */
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