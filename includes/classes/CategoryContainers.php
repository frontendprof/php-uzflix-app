<?php


    class CategoryContainers{
        private $con, $username;

        public function __construct($con,$username){
            $this->con=$con;
            $this->username=$username;

        }

        public function showAllCategories() {
            $query = $this->con->prepare("SELECT * FROM categories");
            $query->execute();
    
            $html = "<div class='previewCategories'>";
    
            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                // var_dump($row["name"] . "<br>");
                // $html .= $row["name"];
                $html = $this->getCategoryHtml($row,null,true,true);
            }
            
            echo $html . "</div>";
        }

        private function getCategoryHtml($sqlData,$title,$tvShows, $movies){
            $categoryId=$sqlData["id"];
            $title=$title==null?$sqlData["name"]:$title;

            if($tvShows && $movies){
                $entities=EntityProvider::getEntities($this->con,$categoryId,30);
            }

            else if($tvShows){

            }

            else{
                
            }

            if(sizeof($entities)==0){
                return;
            }

            $entitiesHtml="";
            $previewProvider=new PreviewProvider($this->con,$this->username,);

            foreach($entities as $entity){
                $entitiesHtml .=$previewProvider->createEntityPreviewSquare($entity);
            }





            return $entitiesHtml . "<br>";

        }
    }


?>