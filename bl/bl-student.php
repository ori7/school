<?php
    require_once dirname(__FILE__).'/bl.php';
    require_once dirname(dirname(__FILE__)).'/model/student-model.php';
    
    class businessLogicStudent extends BusinessLogic{
        public function get(){
            $query = 'SELECT * FROM `student`';
            
            $results = $this->dal->select($query);
            $resultsArray = [];

            while ($row = $results->fetch()) {
                array_push($resultsArray, new studentModel($row));
            }    
            return $resultsArray;
        }

        public function getCount() {
            $query = "SELECT COUNT(*) FROM `student`";
            $result = $this->dal->select($query);
            $row = $result->fetch();
            return $row;        
        }

        public function getOneById($id){
            $query = "SELECT * FROM `student` WHERE `student_id` = :a";
            $params = array(
                "a" => $id
            );
            $result = $this->dal->select($query,$params);
            $row = $result->fetch();
            return new studentModel($row);
        }

        public function getOneByName($name){
            $query = "SELECT * FROM `student` WHERE `student_name` = :a";
            $params = array(
                "a" => $name
            );
            $result = $this->dal->select($query,$params);
            $row = $result->fetch();
            return new studentModel($row);
        }

        public function checkName($name){
            $query = "SELECT * FROM `student` WHERE `student_name` = :a";
            $params = array(
                "a" => $name
            );
            $result = $this->dal->select($query,$params);
            $row = $result->fetch();
            return $row;
        }

        public function set($newStudent) {
            $query = "INSERT INTO `student` (`student_name`, `student_phone`, `student_email`, `student_image`)
            VALUES (:a, :b, :c, :d)";
            $params = array(
                "a" => $newStudent->getStudentName(),
                "b" => $newStudent->getStudentPhone(),
                "c" => $newStudent->getStudentEmail(),
                "d" => $newStudent->getStudentImage(),
            );
            $id = $this->dal->insert($query, $params);

            $this->insertRegistration($id,$newStudent->getStudentCourses());
            
            return $id;
        }

        public function getCourses($studentId){
            $query = 'SELECT `courseId` FROM `registration` WHERE `studentId` = :a';
            $params = array(
                "a" => $studentId
            );
            $results = $this->dal->select($query,$params);
            $resultsArray = [];

            while ($row = $results->fetch()) {
                array_push($resultsArray, $row['courseId']);
            }    
            return $resultsArray;
        }

        public function deliteId($id){

            $this->deliteRegistrationByStudentId($id);

            $query = "DELETE FROM `student` WHERE `student_id` = :a";
            $param = array(
                "a" => $id
            );
            $this->dal->delite($query, $param);
        }
        
        public function update($student, $id) {
            $query = "UPDATE `student` SET `student_name`= :a ,`student_phone`= :b ,`student_email`= :c ,`student_image`= :d
            WHERE `student_id` = :e";
            $params = array(
                "a" => $student->getStudentName(),
                "b" => $student->getStudentPhone(),
                "c" => $student->getStudentEmail(),
                "d" => $student->getStudentImage(),
                "e" => $id
            );
            $this->dal->update($query, $params);
            
            $this->deliteRegistrationByStudentId($id);

            $this->insertRegistration($id,$student->getStudentCourses());
        }

        public function deliteRegistrationByStudentId($studentId){
            $query = "DELETE FROM `registration` WHERE `studentId` = :a";
            $params = array(
                $studentId
            );
            $this->dal->delite($query, $params);
        }

        public function insertRegistration($studentId,$StudentCoursesArray){
            for ($i = 0; $i < sizeof($StudentCoursesArray); $i++) {
                $query = "INSERT INTO `registration` (`studentId`, `courseId`) VALUES (:a, :b)";
                $params = array(
                    "a" => $studentId,
                    "b" => $StudentCoursesArray[$i]
                );
                $this->dal->insert($query, $params);
            }
        }
    }
?>

