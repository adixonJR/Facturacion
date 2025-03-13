<?php 
// --
class C_Proforma extends Controller {

    // --
    public function __construct() {
        parent::__construct();
    }
    
    // --
    public function index() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        $this->functions->check_permissions($this->segment->get('modules'), 'Proforma');
        // --
        $this->view->set_js('index');       // -- Load JS
        $this->view->set_menu(array('modules' => $this->segment->get('modules'), 'view' => 'Proforma')); // -- Active Menu
        $this->view->set_view('index');     // -- Load View
    }

    // --
    public function get_proforma() { 
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        // --
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'GET') {
            // --
            $input = json_decode(file_get_contents('php://input'), true);
            if (empty($input)) {
                $input = filter_input_array(INPUT_GET);
            }
            // --
            $obj = $this->load_model('Proforma');
            // --
            $response = $obj->get_proforma();
            // --
            switch ($response['status']) {
                // --
                case 'OK':
                    // --
                    $json = array(
                        'status' => 'OK',
                        'type' => 'success',
                        'msg' => 'Listado de registros encontrados.',
                        'data' => $response['result']
                    );
                    break;
  
                case 'ERROR':
                    // --
                    $json = array(
                        'status' => 'ERROR',
                        'type' => 'warning',
                        'msg' => 'No se encontraron registros en el sistema.',
                        'data' => array(),
                    );
                    break;
  
                case 'EXCEPTION':
                    // --
                    $json = array(
                        'status' => 'ERROR',
                        'type' => 'error',
                        'msg' => $response['result']->getMessage(),
                        'data' => array()
                    );
                    break;
            }
        } else {
            // --
            $json = array(
                'status' => 'ERROR',
                'type' => 'error',
                'msg' => 'Método no permitido.',
                'data' => array()
            ); 
        }
  
        // --
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    // --
    public function get_proforma_by_id() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        // --
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'GET') {
            // --
            $input = json_decode(file_get_contents('php://input'), true);
            if (empty($input)) {
                $input = filter_input_array(INPUT_GET);
            }
            // --
            if (!empty($input['id_proforma'])) {
                // --
                $obj = $this->load_model('Proforma');
                // --
                $bind = array('id_proforma' => intval($input['id_proforma']));
                // --
                $response = $obj->get_proforma_by_id($bind);
                // --
                switch ($response['status']) {
                    // --
                    case 'OK':
                        // --
                        $json = array(
                            'status' => 'OK',
                            'type' => 'success',
                            'msg' => 'Registro encontrado.',
                            'data' => $response['result']
                        );
                        break;
  
                    case 'ERROR':
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'warning',
                            'msg' => 'No se encontró el registro en el sistema.',
                            'data' => array(),
                        );
                        break;
  
                    case 'EXCEPTION':
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'error',
                            'msg' => $response['result']->getMessage(),
                            'data' => array()
                        );
                        break;
                }
            } else {
                // --
                $json = array(
                    'status' => 'ERROR',
                    'type' => 'warning',
                    'msg' => 'No se enviaron los campos necesarios, verificar.',
                    'data' => array()
                );
            }
        } else {
            // --
            $json = array(
                'status' => 'ERROR',
                'type' => 'error',
                'msg' => 'Método no permitido.',
                'data' => array()
            ); 
        }
  
        // --
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    // --
    public function create_proforma() {
        // --
        $this->functions->validate_session($this->segment->get('isActive'));
        // --
        $request = $_SERVER['REQUEST_METHOD'];
        // --
        if ($request === 'POST') {
            // --
            $input = json_decode(file_get_contents('php://input'), true);
            if (empty($input)) {
                $input = filter_input_array(INPUT_POST);
            }
            // --
            if (!empty($input['id_clients']) &&
                !empty($input['id_user']) &&
                !empty($input['id_voucher_type']) &&
                !empty($input['date_issue']) &&
                !empty($input['correlative']) &&
                !empty($input['total_sale']) &&
                !empty($input['status'])
            ) {
                // --
                $bind = array(
                    'id_clients' => $this->functions->clean_string($input['id_clients']),
                    'id_user' => $this->functions->clean_string($input['id_user']),
                    'id_voucher_type' => $this->functions->clean_string($input['id_voucher_type']),
                    'date_issue' => $this->functions->clean_string($input['date_issue']),
                    'correlative' => $this->functions->clean_string($input['correlative']),
                    'total_sale' => $this->functions->clean_string($input['total_sale']),
                    'status' => $this->functions->clean_string($input['status'])
                );

                // --
                $obj = $this->load_model('Proforma');
                $response = $obj->create_proforma($bind);
                // --
                switch ($response['status']) {
                    // --
                    case 'OK':
                        // --
                        $json = array(
                            'status' => 'OK',
                            'type' => 'success',
                            'msg' => 'Proforma creada con éxito.',
                            'data' => array()
                        );
                        break;

                    case 'ERROR':
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'warning',
                            'msg' => 'No fue posible crear la proforma, verificar.',
                            'data' => array());
                            break;
                            case 'EXCEPTION':
                                // --
                                $json = array(
                                    'status' => 'ERROR',
                                    'type' => 'error',
                                    'msg' => $response['result']->getMessage(),
                                    'data' => array()
                                );
                                break;
                        }
                    } else {
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'warning',
                            'msg' => 'No se enviaron los campos necesarios, verificar.',
                            'data' => array()
                        );
                    }
                } else {
                    // --
                    $json = array(
                        'status' => 'ERROR',
                        'type' => 'error',
                        'msg' => 'Método no permitido.',
                        'data' => array()
                    ); 
                }
            
                // --
                header('Content-Type: application/json');
                echo json_encode($json);
            }
            
            // --
            public function update_proforma() {
                // --
                $this->functions->validate_session($this->segment->get('isActive'));
                // --
                $request = $_SERVER['REQUEST_METHOD'];
                // --
                if ($request === 'POST') {
                    // --
                    $input = json_decode(file_get_contents('php://input'), true);
                    if (empty($input)) {
                        $input = filter_input_array(INPUT_POST);
                    }
                    // --
                    if (!empty($input['id_proforma']) && 
                        !empty($input['id_clients']) &&
                        !empty($input['id_user']) &&
                        !empty($input['id_voucher_type']) &&
                        !empty($input['date_issue']) &&
                        !empty($input['correlative']) &&
                        !empty($input['total_sale']) &&
                        !empty($input['status'])
                    ) {
                        // --
                        $bind = array(
                            'id_proforma' => $this->functions->clean_string($input['id_proforma']),
                            'id_clients' => $this->functions->clean_string($input['id_clients']),
                            'id_user' => $this->functions->clean_string($input['id_user']),
                            'id_voucher_type' => $this->functions->clean_string($input['id_voucher_type']),
                            'date_issue' => $this->functions->clean_string($input['date_issue']),
                            'correlative' => $this->functions->clean_string($input['correlative']),
                            'total_sale' => $this->functions->clean_string($input['total_sale']),
                            'status' => $this->functions->clean_string($input['status'])
                        );
            
                        // --
                        $obj = $this->load_model('Proforma');
                        $response = $obj->update_proforma($bind);
                        // --
                        switch ($response['status']) {
                            // --
                            case 'OK':
                                // --
                                $json = array(
                                    'status' => 'OK',
                                    'type' => 'success',
                                    'msg' => 'Proforma actualizada con éxito.',
                                    'data' => array()
                                );
                                break;
            
                            case 'ERROR':
                                // --
                                $json = array(
                                    'status' => 'ERROR',
                                    'type' => 'warning',
                                    'msg' => 'No fue posible actualizar la proforma, verificar.',
                                    'data' => array(),
                                );
                                break;
            
                            case 'EXCEPTION':
                                // --
                                $json = array(
                                    'status' => 'ERROR',
                                    'type' => 'error',
                                    'msg' => $response['result']->getMessage(),
                                    'data' => array()
                                );
                                break;
                        }
                    } else {
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'warning',
                            'msg' => 'No se enviaron los campos necesarios, verificar.',
                            'data' => array()
                        );
                    }
                } else {
                    // --
                    $json = array(
                        'status' => 'ERROR',
                        'type' => 'error',
                        'msg' => 'Método no permitido.',
                        'data' => array()
                    ); 
                }
            
                // --
                header('Content-Type: application/json');
                echo json_encode($json);
            }
            
            // --
            public function delete_proforma() {
                // --
                $this->functions->validate_session($this->segment->get('isActive'));
                // --
                $request = $_SERVER['REQUEST_METHOD'];
                // --
                if ($request === 'POST') {
                    // --
                    $input = json_decode(file_get_contents('php://input'), true);
                    if (empty($input)) {
                        $input = filter_input_array(INPUT_POST);
                    }
                    // --
                    if (!empty($input['id_proforma'])) {
                        // --
                        $id_proforma = $this->functions->clean_string($input['id_proforma']); // Asegúrate de que esta línea esté correcta
                        // --
                        $bind = array(
                            'id_proforma' => $id_proforma
                        );
                        // --
                        $obj = $this->load_model('Proforma');
                        $response = $obj->delete_proforma($bind);
                        // --
                        switch ($response['status']) {
                            // --
                            case 'OK':
                                // --
                                $json = array(
                                    'status' => 'OK',
                                    'type' => 'success',
                                    'msg' => 'Registro eliminado del sistema con éxito.',
                                    'data' => array()
                                );
                                break;
            
                            case 'ERROR':
                                // --
                                $json = array(
                                    'status' => 'ERROR',
                                    'type' => 'warning',
                                    'msg' => 'No fue posible eliminar el registro, verificar.',
                                    'data' => array(),
                                );
                                break;
            
                            case 'EXCEPTION':
                                // --
                                $json = array(
                                    'status' => 'ERROR',
                                    'type' => 'error',
                                    'msg' => $response['result']->getMessage(),
                                    'data' => array()
                                );
                                break;
                        }
                    } else {
                        // --
                        $json = array(
                            'status' => 'ERROR',
                            'type' => 'warning',
                            'msg' => 'No se enviaron los campos necesarios, verificar.',
                            'data' => array()
                        );
                    }
                } else {
                    // --
                    $json = array(
                        'status' => 'ERROR',
                        'type' => 'error',
                        'msg' => 'Método no permitido.',
                        'data' => array()
                    ); 
                }
            
                // --
                header('Content-Type: application/json');
                echo json_encode($json);
            }
            
            // --
            public function get_business_name() {
                // --
                $this->functions->validate_session($this->segment->get('isActive'));
                // --
                $request = $_SERVER['REQUEST_METHOD'];
                // --
                if ($request === 'GET') {
                    // --
                    $input = json_decode(file_get_contents('php://input'), true);
                    if (empty($input)) {
                        $input = filter_input_array(INPUT_GET);
                    }
                    // --
                    $obj = $this->load_model('Clients');
                    // --
                    $response = $obj->get_business_name();
                    // --
                    switch ($response['status']) {
                        // --
                        case 'OK':
                            // --
                            $json = array(
                                'status' => 'OK',
                                'type' => 'success',
                                'msg' => 'Listado de registros encontrados.',
                                'data' => $response['result']
                            );
                            break;
            
                        case 'ERROR':
                            // --
                            $json = array(
                                'status' => 'ERROR',
                                'type' => 'warning',
                                'msg' => 'No se encontraron registros en el sistema.',
                                'data' => array(),
                            );
                            break;
            
                        case 'EXCEPTION':
                            // --
                            $json = array(
                                'status' => 'ERROR',
                                'type' => 'error',
                                'msg' => $response['result']->getMessage(),
                                'data' => array()
                            );
                            break;
                    }
                } else {
                    // --
                    $json = array(
                        'status' => 'ERROR',
                        'type' => 'error',
                        'msg' => 'Método no permitido.',
                        'data' => array()
                    ); 
                }
            
                // --
                header('Content-Type: application/json');
                echo json_encode($json);
            }
        }
    
                        
