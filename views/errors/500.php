<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Internal Server Error</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background: #f1f3f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            color: #212529;
            line-height: 1.6;
        }
        .container {
            max-width: 900px;
            margin: 5rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .error-code {
            color: #e03131;
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .lead {
            font-size: 1.25rem;
            color: #495057;
            margin-bottom: 2rem;
        }
        .details-box, .technical-details {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 1.5rem;
            margin-top: 2rem;
        }
        .details-title {
            font-weight: bold;
            color: #343a40;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }
        .detail-item {
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }
        .detail-label {
            color: #868e96;
            font-weight: 500;
            min-width: 130px;
            display: inline-block;
        }
        .detail-value {
            color: #495057;
            word-break: break-word;
        }
        pre {
            background: #fff5f5;
            color: #c92a2a;
            padding: 1rem;
            border-radius: 4px;
            font-family: Consolas, monospace;
            font-size: 0.9rem;
            white-space: pre-wrap;
            border-left: 4px solid #ffe3e3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="error-code">500 Error</h1>
        <p class="lead">Oops! Something went wrong on our server. Please try again later.</p>

        <div class="details-box">
            <div class="details-title">Request Details</div>
            <div class="detail-item"><span class="detail-label">URL:</span><span class="detail-value"><?= htmlspecialchars($_SERVER['REQUEST_URI'] ?? '') ?></span></div>
            <div class="detail-item"><span class="detail-label">Method:</span><span class="detail-value"><?= htmlspecialchars($_SERVER['REQUEST_METHOD'] ?? '') ?></span></div>
            <div class="detail-item"><span class="detail-label">Time:</span><span class="detail-value"><?= htmlspecialchars(date('Y-m-d H:i:s')) ?></span></div>
            <div class="detail-item"><span class="detail-label">IP Address:</span><span class="detail-value"><?= htmlspecialchars($_SERVER['REMOTE_ADDR'] ?? 'Unknown') ?></span></div>
        </div>

        <div class="technical-details">
            <div class="details-title">Technical Information</div>
            <div class="detail-item">
                <span class="detail-label">User Agent:</span>
                <div class="detail-value"><?= htmlspecialchars($_SERVER['HTTP_USER_AGENT'] ?? 'Unknown') ?></div>
            </div>
            <div class="detail-item">
                <span class="detail-label">Query String:</span>
                <div class="detail-value"><?= htmlspecialchars($_SERVER['QUERY_STRING'] ?? '') ?></div>
            </div>
            <div class="detail-item">
                <span class="detail-label">Request Headers:</span>
                <pre><?= htmlspecialchars(json_encode(getallheaders(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) ?></pre>
            </div>
        </div>

        <!-- show exception erros -->
        <div class="col-md-8">
            <h1>Error Message</h1>
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
</body>
</html>
