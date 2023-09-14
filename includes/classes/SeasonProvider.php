<?php


    class SeasonProvider{
        private $con, $username;

        public function __construct($con,$username){
            $this->con=$con;
            $this->username=$username;

        }

        public function create($entity){
           $seasons=$entity->getSeasons();

           if(sizeof($seasons)==0){
            return;
           }

           $seasonHtml="";

           foreach($seasons as $season){
                $seasonNumber=$season->getSeasonNumber();

                $videoHtml="";
                foreach($season->getVideos() as $video){
                    $videoHtml .=$this->createVideoSquare($video);
                }




                $seasonHtml .="<div class='season'>
                                    <h3>Season $seasonNumber</h3>
                                    <div class='videos'>
                                        $videoHtml
                                    </div>
                                </div>";

           }

           return $seasonHtml;
        }

        private function createVideoSquare($video){
            $id=$video->getId();
            $title=$video->getTitle();
            $thumbnail=$video->getThumbnail();
            $episodeNumber=$video->getEpisodeNumber();
            $description=$video->getDescription();

            return "<a href='watch.php?id=$id'>
                <div class='episodeContainer'>
                    <div class='contents'>
                        <img src='$thumbnail' alt='$description'>
                        <div class='videoInfo'>
                            <h4>$episodeNumber. $title</h4>
                            <span>$description</span>
                        </div>
                    </div>
                </div>
            </a>";


        }
    }


?>