<?php 
    include_once "header.php";
    session_start();
    if(isset($_SESSION['unique_id'])){
        header("location: users.php");
    }    
?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>ChatO</header>
            <form action="#">
                <div class="error-txt"></div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter your email">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" value="Continue to chat">
                </div>
                <div class="link">Not signed up yet? <a href="index.php">Signup Now</a></div>
            </form>
        </section>
    </div>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/login.js"></script>
</body>
</html>