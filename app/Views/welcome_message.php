<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <img src="<?= base_url('public/images/logo.png') ?>" alt="FJParrado" class="img-fluid" style="max-height: 60px;">
                    
                </div>
                <div class="card-body">
                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger">
                            <?= session('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('login') ?>" method="post">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group text-center">
							<br>
                            <button type="submit" class="btn btn-primary">Acceder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>