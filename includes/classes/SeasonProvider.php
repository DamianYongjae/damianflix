<?php

class SeasonProvider
{
    private $con;
    private $username;

    public function __construct($con, $username)
    {
        $this->con = $con;
        $this->username = $username;
    }

    public function create($entity)
    {
        $seasons = $entity->getSeason();
        if (sizeof($seasons) == 0) {
            return;
        }

        $seasonsHtml = "";
        foreach ($seasons as $season) {
            $seasonNumber = $season->getSeasonNumber();
            $episodes = $season->getVideos();
            $seasonsHtml .= "<div class='season'>
                                <h3>Season $seasonNumber</h3>
                                <div class='episodes'>";
            $episodeHtml = "";
            foreach ($episodes as $episode) {
                $episodeHtml .= $this->createVideoSquare($episode);
            }
            $seasonsHtml .= $episodeHtml . "</div></div>";
        }
        return $seasonsHtml;
    }

    private function createVideoSquare($video)
    {
        $id = $video->getId();
        $title = $video->getTitle();
        $description = $video->getDescription();
        $thumbnail = $video->getThumbnail();
        $episodeNumber = $video->getEpisodeNumber();
        $hasSeen = $video->hasSeen($this->username) ? "<i class='fas fa-check-circle seen'></i>" : "";

        return (
            "<a href='watch.php?id=$id' class='episodeContainer'>
                <div class='episodeThumbnail'><img src=$thumbnail></div>
                <div class='episodeTitle'>$episodeNumber. $title</div>
                <div class='episodeDescription'>$description</div>
                $hasSeen
            </a>"
        );
    }

}
