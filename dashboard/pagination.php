<div class="pagination">
    <?php 
    if (isset($_GET['admin'])) {
        // Previous Page Link
        if ($page > 1): ?>
            <a href="admin.php?lag=1&admin=1&page=<?= $page - 1; ?>" class="pagination-link">Previous</a>
        <?php endif; 
        
        // Page Number Links
        for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="admin.php?lag=1&admin=1&page=<?= $i; ?>" class="pagination-link <?= $i === $page ? 'active' : ''; ?>"><?= $i; ?></a>
        <?php endfor; 
        
        // Next Page Link
        if ($page < $totalPages): ?>
            <a href="admin.php?lag=1&admin=1&page=<?= $page + 1; ?>" class="pagination-link">Next</a>
        <?php endif; 
    }else { ?>
        <?php if ($page > 1): ?>
            <a href="dashboard.php?lag=1&page=<?= $page - 1; ?>" class="pagination-link">Previous</a>
        <?php endif; ?>
        
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="dashboard.php?lag=1&page=<?= $i; ?>" class="pagination-link <?= $i === $page ? 'active' : ''; ?>"><?= $i; ?></a>
        <?php endfor; ?>
        
        <?php if ($page < $totalPages): ?>
            <a href="dashboard.php?lag=1&page=<?= $page + 1; ?>" class="pagination-link">Next</a>
        <?php endif; ?>
    <?php } ?>
</div>

<style>
/* Pagination section */
.pagination {
    margin: 20px 0;
}

.pagination-link {
    margin: 0 5px;
    padding: 5px 10px;
    border: 1px solid #007bff;
    color: #007bff;
    text-decoration: none;
}

.pagination-link.active {
    background-color: #007bff;
    color: #fff;
    border:
