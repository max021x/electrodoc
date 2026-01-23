  <?php
    $queryParams = $_GET;
    unset($queryParams['page']);

    function buildQueryString(array $params, $page): string
    {
        $params['page'] = $page;
        return htmlspecialchars(http_build_query($params));
    }

    $range = 2;
    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);
    ?>

  <?php if ($totalPages > 1): ?>
      <nav aria-label="Posts pagination" class="mt-5">
          <ul class="pagination justify-content-center">

              <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                  <a class="page-link"
                      href="?<?= buildQueryString($queryParams, $currentPage - 1) ?>"
                      aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                  </a>
              </li>

              <?php if ($start > 1): ?>
                  <li class="page-item">
                      <a class="page-link" href="?<?= buildQueryString($queryParams, 1) ?>">1</a>
                  </li>
                  <?php if ($start > 2): ?>
                      <li class="page-item disabled">
                          <span class="page-link">...</span>
                      </li>
                  <?php endif; ?>
              <?php endif; ?>

              <?php for ($i = $start; $i <= $end; $i++): ?>
                  <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                      <?php if ($i == $currentPage): ?>
                          <span class="page-link" aria-current="page"><?= $i ?></span>
                      <?php else: ?>
                          <a class="page-link" href="?<?= buildQueryString($queryParams, $i) ?>"><?= $i ?></a>
                      <?php endif; ?>
                  </li>
              <?php endfor; ?>

              <?php if ($end < $totalPages): ?>
                  <?php if ($end < $totalPages - 1): ?>
                      <li class="page-item disabled">
                          <span class="page-link">...</span>
                      </li>
                  <?php endif; ?>
                  <li class="page-item">
                      <a class="page-link" href="?<?= buildQueryString($queryParams, $totalPages) ?>"><?= $totalPages ?></a>
                  </li>
              <?php endif; ?>

              <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
                  <a class="page-link"
                      href="?<?= buildQueryString($queryParams, $currentPage + 1) ?>"
                      aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                  </a>
              </li>

          </ul>
      </nav>
  <?php endif; ?>