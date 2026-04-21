<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-warning">
                <h4 class="mb-0">Edit Employee</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="/update">
                    <input type="hidden" name="id" value="<?= $employee['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Ad</label>
                        <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($employee['first_name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Soyad</label>
                        <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($employee['last_name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($employee['email']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefon</label>
                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($employee['phone']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Vəzifə</label>
                        <input type="text" name="position" class="form-control" value="<?= htmlspecialchars($employee['position']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Maaş</label>
                        <input type="number" step="0.01" name="salary" class="form-control" value="<?= $employee['salary'] ?>">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="/" class="btn btn-secondary">Geri</a>
                        <button type="submit" class="btn btn-warning">Yenilə</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>