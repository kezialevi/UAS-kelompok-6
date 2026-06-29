<?php require 'header.php'; ?>

<div class="row justify-content-center">

    <div class="col-md-4">

        <div class="card shadow">

            <div class="card-header text-center">

                <h4>Login</h4>

            </div>

            <div class="card-body">

                <form
                    method="POST"
                    action="../app/controllers/AuthController.php?action=login">

                    <div class="mb-3">

                        <label>Email</label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label>Password</label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required>

                    </div>

                    <div class="form-check mb-3">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="remember"
                            id="remember">

                        <label
                            class="form-check-label"
                            for="remember">

                            Ingat Saya

                        </label>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary w-100">

                        Login

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?php require 'footer.php'; ?>