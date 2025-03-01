<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&family=Prompt:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- เชื่อมโยง Bootstrap CSS ครั้งเดียว -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- เชื่อมโยง Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<style>
    td,
    th {
        padding: 10px;
        font-weight: 400;
        font-family: 'Prompt';
        border: none;
    }

    .fon {
        font-family: 'Prompt';
        font-size: 25px;
        font-weight: 200;
    }

    .filter {
        backdrop-filter: blur(3px);
        box-shadow: 0 0px 20px rgba(245, 162, 245, 0.75);
        border-radius: 20px;
    }

    h1 {
        font-size: 100px;
    }

    h2 {
        color: rgba(255, 255, 255, 0.8);
        text-transform: uppercase;
        font-size: 50px;
        letter-spacing: 2px;
        padding-left: 10px;
    }

    .login {
        padding: 20px;
        background: rgba(0, 0, 0, 0);
        /* พื้นหลังโปร่งใส */

    }

    body {
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background: url('https://i.pinimg.com/originals/89/dd/d5/89ddd54255e578c5402519868f438c0b.png');

        background-position: center;
        background-size: cover;
    }

    label {
        color: rgba(0, 0, 0, 0.8);
        text-transform: uppercase;
        font-size: 10px;
        letter-spacing: 2px;
        padding-left: 10px;
    }

    .input{
        background: rgba(255, 255, 255, 0.3);
        height: 40px;
        line-height: 40px;
        border-radius: 20px;
        padding: 0px 20px;
        border: none;
        margin-bottom: 20px;
        color: white;
    }

    .input-icon {
        position: relative;
    }

    .input-icon i {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        color: white;
    }

    .button {
        background: rgb(45, 126, 231);
        height: 40px;
        line-height: 40px;
        border-radius: 20px;
        padding: 0px 20px;
        border: none;
        margin: 10px 0px;

    }
</style>

<body>
    <section class="container mt-5" style="height: 90vh;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login">
                    <h2 class="text-center mb-4" style="color: black;">Login</h2>
                    <form action="/login" method="post">
                        <div class="mb-3 ">
                            <i class="fas fa-user"></i> <!-- ไอคอนของคน -->

                            <label for="email" class="form-label">อีเมล:</label>
                            <input type="email" id="email" name="email" class="form-control input" placeholder="  " required>
                        </div>
                        <div class="mb-3">
                            <i class="fas fa-lock"></i> <!-- ไอคอนของกุญแจล็อก -->

                            <label for="password" class="form-label">รหัสผ่าน:</label>
                            <input type="password" id="password" name="password" class="form-control input" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary button">เข้าสู่ระบบ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>