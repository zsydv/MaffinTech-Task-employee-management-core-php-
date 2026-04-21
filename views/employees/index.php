<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Employee List</h2>
    <a href="/create" class="btn btn-primary">+ Yeni Employee</a>
</div>
 
<form method="GET" action="/" class="mb-3" id="searchForm">
    <div class="input-group">
        <input type="text" name="search" class="form-control" id="searchInput" placeholder="Ad və ya email axtar" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit" class="btn btn-outline-secondary">Axtar</button>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-bordered table-hover bg-white">
        <thead class="table-dark">
            <tr>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Vəzifə</th>
                <th>Maaş</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="employeeTable">
            <?php foreach ($employees as $emp): ?>
                <tr>
                    <td><?= htmlspecialchars($emp['first_name']) ?></td>
                    <td><?= htmlspecialchars($emp['last_name']) ?></td>
                    <td><?= htmlspecialchars($emp['email']) ?></td>
                    <td><?= htmlspecialchars($emp['phone']) ?></td>
                    <td><?= htmlspecialchars($emp['position']) ?></td>
                    <td><?= number_format($emp['salary'], 2) ?></td>
                    <td>
                        <a href="/edit?id=<?= $emp['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <form method="POST" action="/delete" style="display:inline;" onsubmit="return confirm('Əminsən?')">
                            <input type="hidden" name="id" value="<?= $emp['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php if ($totalPages > 1): ?>
<nav>
    <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= ($i == ($_GET['page'] ?? 1)) ? 'active' : '' ?>">
                <a class="page-link" href="/?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>

<script>
(function () {
    const input = document.getElementById('searchInput');
    const table = document.getElementById('employeeTable');
    let timeout = null;

    input.addEventListener('keyup', function () {
        const query = this.value.trim();

        if (query === '') {
            location.href = '/';
            return;
        }

        clearTimeout(timeout);
        timeout = setTimeout(() => {
            fetch(`/search?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    table.innerHTML = data.map(emp => `
                        <tr>
                            <td>${escapeHtml(emp.first_name)}</td>
                            <td>${escapeHtml(emp.last_name)}</td>
                            <td>${escapeHtml(emp.email)}</td>
                            <td>${escapeHtml(emp.phone)}</td>
                            <td>${escapeHtml(emp.position)}</td>
                            <td>${parseFloat(emp.salary).toFixed(2)}</td>
                            <td>
                                <a href="/edit?id=${emp.id}" class="btn btn-sm btn-warning">Edit</a>
                                <form method="POST" action="/delete" style="display:inline;" onsubmit="return confirm('Əminsən?')">
                                    <input type="hidden" name="id" value="${emp.id}">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    `).join('');
                });
        }, 300);
    });

    function escapeHtml(text) {
        if (!text) return '';
        return String(text)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
    }
}());
</script>