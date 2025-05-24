<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 500 - Internal Server Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error-hero {
            background: linear-gradient(135deg, #fff5f5 0%, #f8f9fa 100%);
            min-height: 100vh;
        }
        
        .error-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .error-card:hover {
            transform: translateY(-5px);
        }

        .error-code {
            font-size: 4rem;
            font-weight: 800;
            background: linear-gradient(45deg, #dc3545, #c82333);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .technical-details {
            font-family: 'SFMono-Regular', Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 0.85em;
        }

        .copy-button {
            position: absolute;
            right: 1rem;
            top: 1rem;
        }
    </style>
</head>
<body class="error-hero">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/logo.svg" alt="Logo" height="30">
            </a>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="error-card bg-white p-2 p-md-2 mb-2">
                    <div class="text-center mb-4">
                        <div class="error-code mb-3">500</div>
                        <h1 class="h2 mb-3">Internal Server Error</h1>
                        <p class="lead text-muted">
                            Oops! Something went wrong on our servers. We're working to fix the issue.
                        </p>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-exclamation-triangle display-4 text-danger">...</i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">

                                <!-- Request Details Card -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">
                                                <i class="bi bi-info-circle me-2"></i>
                                                Request Details
                                            </h5>
                                            <dl class="row mb-0">
                                                <dt class="col-sm-5 text-muted">URL:</dt>
                                                <dd class="col-sm-7"><?= htmlspecialchars($_SERVER['REQUEST_URI']) ?></dd>
        
                                                <dt class="col-sm-5 text-muted">Method:</dt>
                                                <dd class="col-sm-7"><?= htmlspecialchars($_SERVER['REQUEST_METHOD']) ?></dd>
        
                                                <dt class="col-sm-5 text-muted">Time:</dt>
                                                <dd class="col-sm-7"><?= date('Y-m-d H:i:s') ?></dd>
        
                                                <dt class="col-sm-5 text-muted">IP Address:</dt>
                                                <dd class="col-sm-7"><?= htmlspecialchars($_SERVER['REMOTE_ADDR']) ?></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
        
                                <!-- Client Details Card -->
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">
                                                <i class="bi bi-pc me-2"></i>
                                                Client Information
                                            </h5>
                                            <dl class="row mb-0">
                                                <dt class="col-sm-5 text-muted">Browser:</dt>
                                                <dd class="col-sm-7"><?= htmlspecialchars($_SERVER['HTTP_USER_AGENT']) ?></dd>
        
                                                <dt class="col-sm-5 text-muted">Referrer:</dt>
                                                <dd class="col-sm-7"><?= htmlspecialchars($_SERVER['HTTP_REFERER'] ?? 'N/A') ?></dd>
        
                                                <dt class="col-sm-5 text-muted">Protocol:</dt>
                                                <dd class="col-sm-7"><?= htmlspecialchars($_SERVER['SERVER_PROTOCOL']) ?></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
        
                            </div>
                            
                            <!-- Technical Details -->
                            <div class="card border-danger mt-4">
                                <div class="card-header bg-danger text-white">
                                    Technical Details
                                    <button class="btn btn-sm btn-light copy-button" onclick="copyTechnicalDetails()">
                                        <i class="bi bi-clipboard"></i>
                                    </button>
                                </div>
                                <div class="card-body technical-details p-2">
                                    <pre class="m-0 p-3"><code><?= htmlspecialchars(json_encode([
                                        'timestamp' => date('c'),
                                        'error' => '500 - Internal Server Error',
                                        'path' => $_SERVER['REQUEST_URI'],
                                        'query' => $_SERVER['QUERY_STRING'] ?? [],
                                        'headers' => getallheaders()
                                    ], JSON_PRETTY_PRINT)) ?></code></pre>
                                </div>
                            </div>
        
                            <div class="text-center mt-4">
                                <a href="/" class="btn btn-primary px-4">
                                    <i class="bi bi-house-door me-2"></i>
                                    Return Home
                                </a>
                                <button class="btn btn-outline-secondary px-4 ms-2" data-bs-toggle="modal" data-bs-target="#contactModal">
                                    <i class="bi bi-envelope me-2"></i>
                                    Contact Support
                                </button>
                            </div>

                        </div>

                        <div class="col-md-x">
                            <?php if (isset($exception)): ?>
                                <div class="detail-item">
                                    <span class="detail-label">Exception Message:</span>
                                    <pre><?= htmlspecialchars($exception->getMessage()) ?></pre>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">File:</span>
                                    <div class="detail-value"><?= htmlspecialchars($exception->getFile()) ?>:<?= $exception->getLine() ?></div>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Stack Trace:</span>
                                    <pre><?= htmlspecialchars($exception->getTraceAsString()) ?></pre>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                </div>

                <footer class="text-center text-muted mt-4">
                    <p class="small">&copy; <?= date('Y') ?> Yohacodes. All rights reserved.</p>
                </footer>
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Contact Support</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Add your contact form here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyTechnicalDetails() {
            const text = document.querySelector('.technical-details pre').innerText;
            navigator.clipboard.writeText(text).then(() => {
                const btn = document.querySelector('.copy-button');
                btn.innerHTML = '<i class="bi bi-check2"></i>';
                setTimeout(() => {
                    btn.innerHTML = '<i class="bi bi-clipboard"></i>';
                }, 2000);
            });
        }
    </script>
</body>
</html>