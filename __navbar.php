<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">通訊錄</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?= $pname=='index' ? 'active' : '' ?>">
                    <a class="nav-link" href="ab_index.php">Home</a>
                </li>
                <li class="nav-item <?= $pname=='list' ? 'active' : '' ?>">
                    <a class="nav-link" href="ab_list.php">List</a>
                </li>
                <li class="nav-item <?= $pname=='add' ? 'active' : '' ?>">
                    <a class="nav-link" href="ab_add.php">Add</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<style>
    li.active{
        background-color: #3581bf;
    }
</style>