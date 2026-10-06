<style>
    :root {
        --pmc-footer-ink: #111a18;
        --pmc-footer-ink-deep: #0b1211;
        --pmc-footer-surface: rgba(255, 255, 255, .055);
        --pmc-footer-line: rgba(236, 212, 154, .18);
        --pmc-footer-gold: #ecd49a;
        --pmc-footer-muted: rgba(255, 255, 255, .68);
    }

    #footer-pmc {
        background-color: var(--pmc-footer-ink);
        background-image:
            linear-gradient(135deg, rgba(39, 61, 56, .68), rgba(17, 26, 24, .97) 48%, rgba(11, 18, 17, .99)),
            repeating-linear-gradient(125deg, transparent 0 34px, rgba(236, 212, 154, .035) 35px, transparent 36px 70px);
        color: #fff;
        font-family: "DM Sans", sans-serif;
        overflow: hidden;
        padding: 68px 0 0;
        position: relative;
    }
    #footer-pmc::before {
        background: var(--pmc-footer-gold);
        content: '';
        height: 4px;
        left: 0;
        opacity: .95;
        position: absolute;
        right: 0;
        top: 0;
    }
    #footer-pmc .footer-brand {
        align-items: center;
        display: flex;
        gap: 28px;
    }
    #footer-pmc .footer-brand img {
        background: rgba(255, 255, 255, .96);
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .16);
        height: 76px;
        object-fit: contain;
        padding: 9px 13px;
        width: 154px;
    }
    #footer-pmc .footer-brand-copy {
        border-left: 1px solid var(--pmc-footer-line);
        padding-left: 28px;
    }
    #footer-pmc .footer-tagline {
        color: var(--pmc-footer-muted);
        font-size: 14px;
        line-height: 1.7;
        margin: 0;
        max-width: 330px;
    }
    #footer-pmc .footer-tagline strong {
        color: var(--pmc-footer-gold);
    }
    #footer-pmc .footer-divider {
        border: none;
        border-top: 1px solid var(--pmc-footer-line);
        margin: 44px 0 36px;
    }
    #footer-pmc .footer-col-title {
        color: var(--pmc-footer-gold);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.7px;
        margin-bottom: 18px;
        text-transform: uppercase;
    }
    #footer-pmc .footer-col-title::after {
        background: var(--pmc-footer-gold);
        content: '';
        display: block;
        height: 2px;
        margin-top: 9px;
        opacity: .65;
        width: 24px;
    }
    #footer-pmc .footer-column {
        background: var(--pmc-footer-surface);
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: 14px;
        min-height: 168px;
        padding: 22px 22px 14px;
        transition: border-color .2s ease, transform .2s ease, background-color .2s ease;
    }
    #footer-pmc .footer-column:hover {
        background: rgba(255, 255, 255, .08);
        border-color: var(--pmc-footer-line);
        transform: translateY(-3px);
    }
    #footer-pmc .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    #footer-pmc .footer-links li {
        margin-bottom: 9px;
    }
    #footer-pmc .footer-links li a {
        align-items: center;
        color: var(--pmc-footer-muted);
        display: flex;
        font-size: 13px;
        gap: 6px;
        text-decoration: none;
        transition: color .2s ease, gap .2s ease;
    }
    #footer-pmc .footer-links li a::before {
        color: var(--pmc-footer-gold);
        content: '\2192';
        font-size: 14px;
        line-height: 1;
    }
    #footer-pmc .footer-links li a:hover {
        color: #fff;
        gap: 12px;
    }
    #footer-copyrights {
        background-color: rgba(10, 18, 16, .48);
        border-top: 1px solid var(--pmc-footer-line);
        margin-top: 48px;
        padding: 20px 0;
    }
    #footer-copyrights .copy-text {
        color: rgba(255, 255, 255, .48);
        font-size: 12px;
        line-height: 1.7;
    }
    #footer-copyrights .copy-text a {
        color: rgba(255, 255, 255, .62) !important;
        transition: color .2s ease;
    }
    #footer-copyrights .copy-text a:hover {
        color: var(--pmc-footer-gold) !important;
    }
    #footer-copyrights .copy-links a {
        color: rgba(255, 255, 255, .62);
        font-size: 12px;
        margin: 0 6px;
        text-decoration: none;
        transition: color .2s ease;
    }
    #footer-copyrights .copy-links a:hover {
        color: var(--pmc-footer-gold);
    }
    #footer-copyrights .copy-links a + a::before {
        content: '/';
        margin-right: 12px;
        color: rgba(255, 255, 255, .22);
    }
    @media (max-width: 767.98px) {
        #footer-pmc {
            padding-top: 48px;
        }
        #footer-pmc > .container,
        #footer-pmc #footer-copyrights > .container {
            max-width: none;
            padding-left: 12px;
            padding-right: 12px;
            width: 100%;
        }
        #footer-pmc .footer-brand {
            align-items: flex-start;
            flex-direction: column;
            gap: 20px;
        }
        #footer-pmc .footer-brand-copy {
            border-left: 0;
            border-top: 1px solid var(--pmc-footer-line);
            padding-left: 0;
            padding-top: 18px;
        }
        #footer-pmc .footer-column {
            min-height: 0;
        }
        #footer-copyrights .copy-links {
            line-height: 2.2;
        }
    }
</style>

<footer id="footer-pmc">
    <div class="container">

        {{-- Brand + tagline --}}
        <div class="footer-brand">
            <img src="{{ asset('img/pmc-logo.png') }}" alt="PMC Logo">
            <div class="footer-brand-copy">
                <p class="footer-tagline mb-0">
                    A <strong>Socially Responsible</strong> &amp; <strong>Environment Friendly</strong> Company
                </p>
            </div>
        </div>

        <hr class="footer-divider">

        {{-- Navigation columns --}}
        <div class="row">
            <div class="col-lg-3 col-6 mb-4"><div class="footer-column">
                <div class="footer-col-title">Company</div>
                <ul class="footer-links">
                    <li><a href="https://cms4.webfocusprod.wsiph2.com/pmc-site-new/pmc-site/public">Home</a></li>
                    <li><a href="https://cms4.webfocusprod.wsiph2.com/pmc-site-new/pmc-site/public/the-way-of-the-tiger">About</a></li>
                    <li><a href="https://cms4.webfocusprod.wsiph2.com/pmc-site-new/pmc-site/public/careers">Career</a></li>
                </ul>
            </div></div>

            <div class="col-lg-3 col-6 mb-4"><div class="footer-column">
                <div class="footer-col-title">Sustainability</div>
                <ul class="footer-links">
                    <li><a href="https://cms4.webfocusprod.wsiph2.com/pmc-site-new/pmc-site/public/news?category=Community Social Responsibility">CSR</a></li>
                    <li><a href="https://cms4.webfocusprod.wsiph2.com/pmc-site-new/pmc-site/public/news?category=Health and Safety">Health and Safety</a></li>
                    <li><a href="https://cms4.webfocusprod.wsiph2.com/pmc-site-new/pmc-site/public/news?category=Community Programs">Community Relations</a></li>
                </ul>
            </div></div>

            <div class="col-lg-3 col-6 mb-4"><div class="footer-column">
                <div class="footer-col-title">Resources</div>
                <ul class="footer-links">
                    <li><a target="_blank" href="https://vendor.philsaga.com">Supplier Portal</a></li>
                    <li><a target="_blank" href="https://www.x64.gold/projects/overview">Projects</a></li>
                    <li><a href="https://cms4.webfocusprod.wsiph2.com/pmc-site-new/pmc-site/public/the-vein">The Vein</a></li>
                </ul>
            </div></div>

            <div class="col-lg-3 col-6 mb-4"><div class="footer-column">
                <div class="footer-col-title">More</div>
                <ul class="footer-links">
                    <li><a href="https://cms4.webfocusprod.wsiph2.com/pmc-site-new/pmc-site/public/careers">Career</a></li>
                    <li><a target="_blank" href="https://www.x64.gold/projects/overview">X64</a></li>
                    <li><a href="https://cms4.webfocusprod.wsiph2.com/pmc-site-new/pmc-site/public/sitemap">Site Map</a></li>
                </ul>
            </div></div>
        </div>

    </div>

    {{-- Copyrights bar --}}
    <div id="footer-copyrights">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <span class="copy-text">
                        Copyrights &copy; 2020 All Rights Reserved by PMC &nbsp;&mdash;&nbsp;
                        <a href="https://cms4.webfocusprod.wsiph2.com/pmc-site-new/pmc-site/public/terms-and-conditions" style="color:#666;text-decoration:none;">Terms of Use</a>
                        &nbsp;/&nbsp;
                        <a href="https://cms4.webfocusprod.wsiph2.com/pmc-site-new/pmc-site/public/data-privacy-policy" style="color:#666;text-decoration:none;">Privacy Policy</a>
                    </span>
                </div>
                <div class="col-12 col-md-6 text-center text-md-end">
                    <div class="copy-links">
                        <a href="https://cms4.webfocusprod.wsiph2.com/pmc-site-new/pmc-site/public">Home</a>
                        <a href="https://cms4.webfocusprod.wsiph2.com/pmc-site-new/pmc-site/public/the-way-of-the-tiger">About Us</a>
                        <a href="https://cms4.webfocusprod.wsiph2.com/pmc-site-new/pmc-site/public/careers">Careers</a>
                        <a href="https://www.x64.gold/projects/overview">Projects</a>
                        <a href="#">FAQs</a>
                        <a href="#">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
