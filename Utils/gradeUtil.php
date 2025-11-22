<?php
    function getGrades($grade){
        if($grade >= 80){
            return 'A';
        } else if($grade >= 70){
            return 'A-';
        } else if($grade >= 65){
            return 'B+';
        } else if($grade >= 60){
            return 'B';
        } else if($grade >= 55){
            return 'B-';
        } else if($grade >= 50){
            return 'C+';
        } else if($grade >= 45){
            return 'C';
        } else if($grade >= 40){
            return 'D';
        } else {
            return 'E';
        }
    }
?>