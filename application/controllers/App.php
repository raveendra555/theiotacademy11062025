 <?php
  //ob_start();
  defined('BASEPATH') or exit('No direct script access allowed');

  class App extends CI_Controller
  {
    public function __construct()
    {
      parent::__construct();
      //error_reporting(0);
      $this->load->library('session');
      $this->load->helper('utility_helper');
      $this->load->library('form_validation');
      $this->load->model('AppModel');
      $this->load->model('EmployeeModel');
      $this->load->model('UserModel');
      $this->load->model('DesigModel');
      $this->load->model('UserTypeModel');
      $this->load->model('StudentModel');
      $this->load->model('EventModel');
      $this->load->model('BlogModel');
      $this->load->model('EventLocationModel');
      $this->load->model('TrainerAboutYouModel');
      $this->load->model('TrainerAccountModel');
      $this->load->model('TrainerAddressModel');
      $this->load->model('TrainerCertificationModel');
      $this->load->model('TrainerDetailsModel');
      $this->load->model('TrainerEducationModel');
      $this->load->model('TrainerExperienceModel');
      $this->load->model('TrainerWhyJoinModel');
    }

    public function index()
    {
      $this->load->view('index');
    }

    public function Error_404()
    {
      //$this->load->view('error404');
      $this->load->helper('url');
      redirect('https://www.theiotacademy.co', 301);
    }

    public function eventtemplate()
    {

      $this->load->view('events/eventtemplate');
    }

    public function our_courses_all()
    {
      $this->load->view('ourcourses-all');
    }

    //-------------------------------------------------------------------------------
    public function login_page()
    {
      $this->load->view('login');
    }

    public function dashboard()
    {
      $this->load->view('admin/dashboard');
    }


    public function do_login()
    {
      $this->form_validation->set_rules('loginemail', 'Email Address', 'required');
      $this->form_validation->set_rules('loginpass', 'Password', 'required');

      if ($this->form_validation->run()) {

        $ip = $_SERVER['REMOTE_ADDR'];
        $email_id = $this->input->post('loginemail');
        $password = $this->input->post('loginpass');
        $opstatus = $this->AppModel->authenticate($email_id, $password, $ip);
        if ($opstatus == 1) {

          $user_type_id = $this->session->userdata("user_type_id");

          if (($user_type_id == 1) || ($user_type_id == 2)) {

            redirect(base_url() . 'adashboard');
          } elseif ($user_type_id == 3) {

            $loginAccess = $this->session->userdata("login_access");

            if (!$loginAccess) {

              redirect(base_url() . 'instructor-reg');
            } else {

              redirect(base_url() . 'adashboard');
            }
          } elseif ($user_type_id == 5) {
            redirect(base_url() . 'show-leads');
          } else {
            redirect(base_url() . 'sign-out');
          }
        } else {

          $this->session->set_flashdata('error', 'Invalid! User Name or Password.');
          redirect(base_url() . 'login');
        }
      } else {

        $this->session->set_flashdata('error', 'User Name or Password Cannot Be Empty.');
        redirect(base_url() . 'login');
      }
    }

    public function logout()
    {
      $this->session->sess_destroy();
      redirect(base_url());
    }

    //-------Functions Linked To Course Menu Routes--------------------------
    public function seeds_funds_program_cnt()
    {
      $this->load->view('seeds_funds_program');
    }

    public function course_java_certification_noida()
    {
      $this->load->view('coursepages/course_java_certification_noida');
    }

    public function dsmliotaddcrt()
    {
      $this->load->view('addpages/ds_ml_iot_add_page');
    }

    public function generative_ai_add_cntrl()
    {
      $this->load->view('addpages/genrative_ai_add_page');
    }
    public function christmas_new_year()
    {
      $this->load->view('christmas_new_year_offer');
    }
    public function industry_visit_test_result()
    {
      $this->load->view('addpages/industrial_visit_test_result');
    }

    public function advanced_gen_ai_controller_fun()
    {
      $this->load->view('advanced_gen_ai');
    }

    public function career_sccelx_programs_controller_fun()
    {
      $this->load->view('career_accelx_programs');
    }
    public function short_term_courrses_page()
    {
      redirect('https://www.theiotacademy.co/summer-training-program-in-noida', 301);
    }
    public function short_term_programs_controller_fun()
    {
      $this->load->view('short-term-programs');
    }

    public function data_analyst_crs_by_iitg_fun()
    {
      $this->load->view('data_analyst_iit_guwahati_course');
    }
    public function Payment_summer_training_fun()
    {
      $this->load->view('summer_training_payment');
    }
    /*===Newly Created Page-Controllers From @26-Dec-2020 Start=========*/

    public function industrial_visit_cntrl()
    {
      $this->load->view('industrial_visit');
    }

    public function web_development_coursec()
    {
      //$this->load->view('coursepages/web_development_certification_course'); 
      redirect('https://theiotacademy.co/', 301);
    }
    public function data_analyst_coursec()
    {
      $this->load->view('coursepages/new_data_analyst_course');
    }
    public function five_six_g_events()
    {
      $this->load->view('5g_6g_talks_events');
    }
    public function book_free_demo()
    {
      $this->load->view('book_free_demo');
    }

    public function winter_training()
    {
      $this->load->view('winter_training');
    }

    public function digital_marketing_training()
    {
      $this->load->view('coursepages/digital_marketing_training');
    }

    public function data_science_analytics_machine()
    {
      $this->load->view('data_analytica_ml_generativeai');
    }

    public function python_training()
    {
      $this->load->view('coursepages/custom_course/python_training');
    }

    public function machine_learning_with_python_training()
    {
      $this->load->view('coursepages/custom_course/machine_learning_with_python');
    }

    public function java_development_training()
    {
      $this->load->helper('url');
      redirect('https://www.theiotacademy.co/java-certification-course-in-noida', 301);
    }

    public function embedded_systems_course_cnt()
    {
      $this->load->view('coursepages/custom_course/embedded_system_training_course');
    }

    public function iot_training()
    {
      $this->load->view('coursepages/custom_course/iot_training');
    }
    public function iot_training_noida()
    {
      $this->load->helper('url');
      redirect('https://www.theiotacademy.co/iot-training', 301);
    }

    public function our_placement_student()
    {
      $this->load->view('our_placement_page');
    }
    public function welcome_kit_eictpage()
    {
      $this->load->view('welcome_kit');
    }

    public function new_home_page_fun()
    {
      $this->load->view('new_home_page');
    }

    public function data_analyst_certification_course_fun()
    {
      $this->load->view('data_analyst_certification_course');
    }

    public function data_analyst_gen_ai_certification_course_fun()
    {
      $this->load->view('data_analyst_gen_ai_certification_course');
    }

    public function digital_marketing_training_fun()
    {
      $this->load->view('digital_marketing_training');
    }

    public function embedded_systems_with_ai_fun()
    {
      $this->load->view('embedded_systems_with_ai');
    }

    public function embedded_systems_basic_fun()
    {
      $this->load->view('embedded_systems_basic');
    }
    /*===Newly Created Page-Controllers End ======*/


    //-------Functions Linked To Our Offerings Links--------------


    public function instructors()
    {
      //$this->load->view('instructors'); 
      redirect('https://www.theiotacademy.co', 301);
    }

    public function instructor_reg()
    {
      $this->load->view('trainers/index2');
    }

    //--------------------function for Events---------------------
    public function events()
    {

      $this->load->view('events');
    }


    //-------Functions Linked To Blog Links--------------

    //--------------------------------------------------

    public function summer_training()
    {

      $this->load->view('summer_training');
    }

    public function new_about_us()
    {

      $this->load->view('new-about-us');
    }


    public function contact_us()
    {
      $this->load->view('contact_us');
    }

    public function terms_and_conditions()
    {

      $this->load->view('termandconditions');
    }

    public function refundpolicies()
    {

      $this->load->view('refundpolicies');
    }

    public function privacyandpolicies()
    {

      $this->load->view('privacyandpolicies');
    }

    public function disclaimer()
    {

      $this->load->view('disclaimer');
    }

    // salary prediction
    public function salary_prediction()
    {
      $this->load->view('salarypredictor');
    }
    public function predictor_admin_dashboard()
    {
      $this->load->view('salarypredictoradmin');
    }
  } ?>