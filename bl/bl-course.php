<?php
    require_once dirname(__FILE__).'/bl.php';
    require_once dirname(dirname(__FILE__)).'/model/course-model.php';
    
    class businessLogicCourse extends BusinessLogic{
        public function get() {
            $query = 'SELECT * FROM `course`';
            
            $results = $this->dal->select($query);
            $resultsArray = [];

            while ($row = $results->fetch()) {
                array_push($resultsArray, new courseModel($row));
            }    
            return $resultsArray;
        }

        public function getCount() {
            $query = "SELECT COUNT(*) FROM `course`";
            $result = $this->dal->select($query);
            $row = $result->fetch();
            return $row;        
        }

        public function getOneById($id){
            $query = "SELECT * FROM `course` WHERE `course_id` = :a";
            $params = array(
                "a" => $id
            );
            $result = $this->dal->select($query,$params);
            $row = $result->fetch();
            return new courseModel($row);
        }

        public function getOneByName($name){
            $query = "SELECT * FROM `course` WHERE `course_name` = :a";
            $params = array(
                "a" => $name
            );
            $result = $this->dal->select($query,$params);
            $row = $result->fetch();
            return new courseModel($row);
        }

        public function getStudents($courseId){
            $query = 'SELECT `studentId` FROM `registration` WHERE `courseId` = :a';
            $params = array(
                "a" => $courseId
            );
            $results = $this->dal->select($query,$params);
            $resultsArray = [];

            while ($row = $results->fetch()) {
                array_push($resultsArray, $row['studentId']);
            }    
            return $resultsArray;
        }

        public function checkName($name){
            $query = "SELECT * FROM `course` WHERE `course_name` = :a";
            $params = array(
                "a" => $name
            );
            $result = $this->dal->select($query,$params);
            $row = $result->fetch();
            return $row;
        }

        public function set($newCourse) {
            $query = "INSERT INTO `course` (`course_name`, `course_description`, `course_image`)
            VALUES (:a, :b, :c)";
            $params = array(
                "a" => $newCourse->getCourseName(),
                "b" => $newCourse->getCourseDescription(),
                "c" => $newCourse->getCourseImage(),
            );
            $id = $this->dal->insert($query, $params);
            return $id;
        }

        public function deliteId($id){
            $query = "DELETE FROM `course` WHERE `course_id` = :a";
            $param = array(
                "a" => $id
            );
            $this->dal->delite($query, $param);
        }
        
        public function update($course, $id) {
            $query = "UPDATE `course` SET `course_name`= :a ,`course_description`= :b ,`course_image`= :c
            WHERE `course_id` = :d";
            $params = array(
                "a" => $course->getCourseName(),
                "b" => $course->getCourseDescription(),
                "c" => $course->getCourseImage(),
                "d" => $id
            );
            $this->dal->update($query, $params);
        }
    }
?>

