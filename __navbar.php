<?php
if ($_SESSION['user'] == 'login' || ($_POST['email'] == 'foodtopia@gmail.com' and $_POST['password'] == '123')) {
    $_SESSION['user'] = 'login';     // 代表已登入
} else {
    header("Location: http://localhost:3001/login"); 
    exit;
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-transparent x">
          <div class="container">
        <a class="navbar-brand" href="http://localhost/foodtopia/ab_list.php">Foodtopia</a>
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="http://localhost:3001/homePage">首頁</a>
                </li>
                  <li class="nav-item">
                    <a class="nav-link" href="http://localhost:3001/recipe_head/recipe_list">美味食譜</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost:3001/ingridient_hompage">生鮮食材</a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="">關於我們</a>
                </li> -->

              </ul>
              <!-- <img src='./icons/like.png'/> -->
              <a href='logout01.php' style='text-decoration: none'>
              登出
            </a>
              <!-- <img src='./icons/shopping-bag.png' onClick={this.cartToggle}/>
              <form class="form-inline my-2 my-lg-0">
                <input
                  class="form-control mr-sm-2"
                  type="search"
                  placeholder=""
                  aria-label="Search"/>
                <img src='./icons/Group 13.png'/>
              </form> -->
            </div>
          </div>
        </nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">後台管理</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- <li class="nav-item <?=$pname == 'index' ? 'active' : ''?>">
                    <a class="nav-link" href="ab_index.php">Home</a>
                </li> -->
                <li class="nav-item <?=$pname == 'list' ? 'active' : ''?>">
                    <a class="nav-link" href="ab_list.php">會員列表</a>
                </li>
                <li class="nav-item <?=$pname == 'add' ? 'active' : ''?>">
                    <a class="nav-link" href="ab_add.php">會員新增</a>
                </li>
                <li class="nav-item <?=$pname == 'igr_list' ? 'active' : ''?>">
                    <a class="nav-link" href="ab_igr_list.php">食材列表</a>
                </li>
                <li class="nav-item <?=$pname == 'igr_add' ? 'active' : ''?>">
                    <a class="nav-link" href="ab_igr_add.php">食材新增</a>
                </li>
                <li class="nav-item <?=$pname == 'recipe_list' ? 'active' : ''?>">
                    <a class="nav-link" href="ab_recipe_list.php">食譜列表</a>
                </li>
                <!-- <li class="nav-item <?=$pname == 'add2' ? 'active' : ''?>">
                    <a class="nav-link" href="ab_add2.php">Add(ajax)</a>
                </li> -->
            </ul>
        </div>
    </div>
</nav>
<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">食譜新增</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?=$pname == 'recipe_add' ? 'active' : ''?>">
                    <a class="nav-link" href="ab_recipe_add.php">食譜新增1</a>
                </li>
                <li class="nav-item <?=$pname == 'recipe_add' ? 'active' : ''?>">
                    <a class="nav-link" href="ab_recipe_add2.php">食譜新增2</a>
                </li>
                <li class="nav-item <?=$pname == 'recipe_add' ? 'active' : ''?>">
                    <a class="nav-link" href="ab_recipe_add3.php">食譜新增3</a>
                </li>
                <li class="nav-item <?=$pname == 'recipe_add' ? 'active' : ''?>">
                    <a class="nav-link" href="ab_recipe_add4.php">食譜新增4</a>
                </li> 
                <li class="nav-item <?=$pname == 'recipe_add' ? 'active' : ''?>">
                    <a class="nav-link" href="ab_recipe_add5.php">食譜新增5</a>
                </li> 
            </ul>
        </div>
    </div>
</nav> -->

<style>

    li.active{
        font-weight:600;
    }
    nav {
  font-family: '微軟正黑體';
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
}

.x .navbar-brand {
  font-weight: 600 !important;
  font-size: 1.5em !important;
}

.x .navbar-toggler {
  border: 0px solid #FF4343 !important;
  border-radius: 50% !important;
  padding: 5px;
}

.x .navbar-toggler .navbar-toggler-icon {
  color: #FF4343 !important;
}

.x li {
  margin-left: 35px;
  font-size: .9em;
}

.x a {
  color: #FF4343 !important;
}

.x img {
  width: 1.5em;
  margin-right: 20px;
  cursor: pointer;
}

.x form input {
  border: 1px solid #FF4343 !important;
  border-radius: 20px !important;
}

.x form img {
  -webkit-transform: translateX(-50px);
          transform: translateX(-50px);
}
</style>