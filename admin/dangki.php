<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
      rel="icon"
      href="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/User_icon_2.svg/480px-User_icon_2.svg.png"
    />
    <title>Đăng ký</title>
    <style>
        .custom-form {
            border: 1px solid #007bff;
            padding: 20px;
            width: 400px;
            margin: auto;
            margin-top: 30px;
            border-radius: 10px;
            background-color:#C6E2FF;
        }
        body {
            background: url("../background.png");
            background-repeat: no-repeat;
            background-size: cover;
        }
        .custom-form .head {
            margin-bottom: 20px;
        }

        .custom-form .btn {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="col-lg-6 m-auto">
            <form action="xulydangki.php" method="post" class="custom-form">
            <div class="head text-center">
             <h4 class="text-dark text-white p-2 my-0 mx-n3">ĐĂNG KÝ </h4>
            </div>
                <div class="form-group">
                    <label for="username">Tài Khoản</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="pass">
                </div>
                <div class="form-group">
                    <label for="repass">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control" id="repass" name="repass">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label>Phái:</label>
                    <div class="form-check">
                        <input type="radio" name="phai" id="nam" value=1 class="form-check-input">
                        <label for="nam" class="form-check-label">Nam</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="phai" id="nu" value=0 class="form-check-input">
                        <label for="nu" class="form-check-label">Nữ</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="idgroup">ID GROUP</label>
                    <input type="idgroup" class="form-control" id="idgroup" name="idgroup">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary py-2 px-5 mr-2" value="Đăng ký">
                    <input type="reset" class="btn btn-danger py-2 px-5" value="Làm lại">
                </div>
            </form>
        </div>
    </div>
</body>

</html>