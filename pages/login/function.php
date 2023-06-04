<?php
if (isset($_POST['sign-in'])) {
    session_start();
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Parámetros de conexión a la base de datos
    $host = "localhost"; // Nombre del servidor donde está alojada la base de datos
    $user = "postgres"; // Nombre de usuario de la base de datos
    $password_db = "9090"; // Contraseña de la base de datos
    $dbname = "bd_rentaCar"; // Nombre de la base de datos
    
    try {
        // Establecer la conexión
        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password_db);
        
        // Configurar el modo de error para lanzar excepciones en caso de errores
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Consultar la tabla tbladmin
        $sql = "SELECT admin_id FROM tbladmin WHERE username=? AND password=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $password]);
        
        if ($stmt->rowCount() == 1) {
            // Usuario encontrado en tbladmin
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $admin_id = $row['admin_id'];
            
            $_SESSION['user_id'] = $admin_id;
            $_SESSION['user_type'] = "Administrator";
            header("location:../dashboard/dashboard.php");
        } else {
            // Consultar la tabla tblowner
            $sql = "SELECT owner_id, account_status FROM tblowner WHERE username=? AND password=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $password]);
            
            if ($stmt->rowCount() == 1) {
                // Usuario encontrado en tblowner
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $owner_id = $row['owner_id'];
                $account_status = $row['account_status'];
                
                if ($account_status == 1) {
                    $_SESSION['user_id'] = $owner_id;
                    $_SESSION['user_type'] = "Owner";
                    header("location:../dashboard/dashboard.php");
                } else {
                    echo "
                    <div class='alert alert-warning alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                      <i class='icon fas fa-exclamation-triangle'></i>
                      ¡Tu cuenta está desactivada!
                    </div>
                    ";
                }
            } else {
                // Consultar la tabla tblcustomer
                $sql = "SELECT customer_id, account_status FROM tblcustomer WHERE username=? AND password=?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$username, $password]);
                
                if ($stmt->rowCount() == 1) {
                    // Usuario encontrado en tblcustomer
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $customer_id = $row['customer_id'];
                    $account_status = $row['account_status'];
                    
                    if ($account_status == 1) {
                        $_SESSION['user_id'] = $customer_id;
                        $_SESSION['user_type'] = "Customer";
                        header("location:../dashboard/dashboard.php");
                    } else {
                        echo "
                        <div class='alert alert-warning alert-dismissible'>
                          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                          <i class='icon fas fa-exclamation-triangle'></i>
                          ¡Tu cuenta está desactivada!
                        </div>
                        ";
                    }
                } else {
                    echo "
                    <div class='alert alert-warning alert-dismissible'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                      <i class='icon fas fa-exclamation-triangle'></i>
                      ¡Nombre de usuario o contraseña incorrectos!
                    </div>
                    ";
                }
            }
        }
        
        // Cerrar la conexión
        $conn = null;
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
}
?>
