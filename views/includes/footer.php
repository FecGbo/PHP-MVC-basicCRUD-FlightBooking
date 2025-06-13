<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-left">
            <span>&copy; <?= date('Y') ?> Traveller Go. All rights reserved.</span>
        </div>
        <div class="footer-right">
            <a href="mailto:support@travellergo.com">Contact</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms</a>
        </div>
    </div>
</footer>
<style>
    .site-footer {
        background: #1976d2;
        color: #fff;
        padding: 18px 0 12px 0;
        font-size: 1rem;
        margin-top: 40px;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .footer-left {
        margin-bottom: 8px;
    }

    .footer-right a {
        color: #fff;
        margin-left: 18px;
        text-decoration: none;
        font-size: 1rem;
        transition: color 0.2s;
    }

    .footer-right a:hover {
        color: #90caf9;
        text-decoration: underline;
    }

    @media (max-width: 700px) {
        .footer-container {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .footer-right {
            margin-top: 6px;
        }

        .footer-right a {
            margin-left: 0;
            margin-right: 16px;
        }
    }
</style>