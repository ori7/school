<?php  
    class StudentModel {
        private $student_id;
        private $student_name;
        private $student_phone;
        private $student_email;
        private $student_image;
        private $student_courses;
        
        function __construct($array) {
            if (isset($array['student_id']))
                $this->student_id = $array['student_id'];
            $this->student_name = $array['student_name']; 
            $this->student_phone = $array['student_phone'];
            $this->student_email = $array['student_email'];
            $this->student_image = $array['student_image'];
            if (isset($array['student_courses']))
                $this->student_courses = $array['student_courses'];
        }

        function getStudentId() {
            return $this->student_id;
        }
        function getStudentName() {
            return $this->student_name;
        }
        function getStudentPhone() {
            return $this->student_phone;
        }
        function getStudentEmail() {
            return $this->student_email;
        } 
        function getStudentImage() {
            return $this->student_image;
        }
        function getStudentCourses() {
            if (empty($this->student_courses)) {
                $bls = new businessLogicStudent();
                $this->student_courses = $bls->getCourses($this->student_id);
            }
            return $this->student_courses;
        }

        function setStudentId($student_id) {
            $this->student_id = $student_id;
        }
        function setStudentName($student_name) {
            $this->student_name = $student_name;
        }
        function setStudentPhone($student_phone) {
            $this->student_phone = $student_phone;
        }
        function setStudentEmail($student_email) {
            $this->student_email = $student_email;
        }
        function setStudentImage($student_image) {
            $this->student_image = $student_image;
        }
        function setStudentCourses($student_courses) {
            $this->student_courses = $student_courses;
        }
    }
?>
