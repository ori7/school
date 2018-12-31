<?php  
    class CourseModel {
        private $course_id;
        private $course_name;
        private $course_description;
        private $course_image;
        private $course_students;
        
        function __construct($array) {
            if (isset($array['course_id']))
                $this->course_id = $array['course_id'];
            $this->course_name = $array['course_name']; 
            $this->course_description = $array['course_description'];
            $this->course_image = $array['course_image'];
            if (isset($array['course_students']))
                $this->course_students = $array['course_students'];
        }

        function getCourseId() {
            return $this->course_id;
        }
        function getCourseName() {
            return $this->course_name;
        }
        function getCourseDescription() {
            return $this->course_description;
        }
        function getCourseImage() {
            return $this->course_image;
        }
        function getCourseStudents() {
            if (empty($this->course_students)) {
                $blc = new businessLogicCourse();
                $this->course_students = $blc->getStudents($this->course_id);
            }
            return $this->course_students;
        }

        function setCourseId($course_id) {
            $this->course_id = $course_id;
        }
        function setCourseName($course_name) {
            $this->course_name = $course_name;
        }
        function setCourseDescription($course_description) {
            $this->course_description = $course_description;
        }
        function setCourseImage($course_image) {
            $this->course_image = $course_image;
        }
        function setStudentStudents($course_students) {
            $this->course_students = $course_students;
        }

    }
?>