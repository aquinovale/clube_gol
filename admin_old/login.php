<?php include('topo.php'); ?>
<form class="form-horizontal" action="" method="POST">
    <fieldset>
        <div id="legend">
            <legend class="">ADMIN: Dexter Logística</legend>
        </div>
        <div class="control-group">
            <label class="control-label" for="email">E-mail</label>
            <div class="controls">
                <input type="text" id="username" name="email" placeholder="" class="input-xlarge">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="password">Senha:</label>
            <div class="controls">
                <input type="password" id="password" name="senha" placeholder="" class="input-xlarge">
            </div>
        </div>


        <div class="control-group">
            <!-- Button -->
            <div class="controls">
                <button class="btn btn-success">Login</button>
            </div>
        </div>
    </fieldset>
</form>
<?php include('rodape.php'); ?>