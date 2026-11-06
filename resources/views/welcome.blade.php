<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f5faf8">
    <meta name="description"
        content="Chiamonshop menyediakan pilihan pakan ikan berkualitas. Pesan mudah melalui WhatsApp, Tokopedia, atau TikTok Shop.">
    <title>Chiamonshop — Pakan Ikan Pilihan</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <style>
        :root {
            color-scheme: light;
            --ink: #12363d;
            --muted: #647a7d;
            --deep: #0c3038;
            --teal: #167f78;
            --mint: #e7f4ee;
            --lime: #d7ed9b;
            --paper: #f5faf8;
            --line: #dce9e4;
            --white: #fff;
            --shadow: 0 24px 70px rgba(13, 51, 56, .12);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-synthesis: none;
            text-rendering: optimizeLegibility;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 92px;
        }

        body {
            margin: 0;
            color: var(--ink);
            background: var(--paper);
        }

        body,
        button,
        a {
            font-family: inherit;
        }

        button,
        a {
            -webkit-tap-highlight-color: transparent;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            color: inherit;
        }

        img {
            display: block;
            max-width: 100%;
        }

        .container {
            width: min(1160px, calc(100% - 48px));
            margin-inline: auto;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: var(--teal);
            font-size: .76rem;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .eyebrow::before {
            width: 22px;
            height: 2px;
            content: "";
            background: currentColor;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 50px;
            padding: 0 21px;
            border: 0;
            border-radius: 999px;
            font-size: .9rem;
            font-weight: 750;
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
            cursor: pointer;
        }

        .button:hover {
            transform: translateY(-2px);
        }

        .button-primary {
            color: #fff;
            background: var(--teal);
            box-shadow: 0 10px 24px rgba(22, 127, 120, .2);
        }

        .button-primary:hover {
            background: #116c67;
            box-shadow: 0 14px 28px rgba(22, 127, 120, .25);
        }

        .button-light {
            color: var(--ink);
            background: #fff;
        }

        .button-light:hover {
            box-shadow: 0 10px 25px rgba(12, 48, 56, .1);
        }

        .button-arrow {
            font-size: 1.15rem;
            line-height: 1;
        }

        .announcement {
            padding: 10px 20px;
            color: #e7f4ee;
            background: var(--deep);
            text-align: center;
            font-size: .76rem;
            letter-spacing: .02em;
        }

        .announcement strong {
            color: var(--lime);
        }

        .site-header {
            position: sticky;
            z-index: 20;
            top: 0;
            border-bottom: 1px solid rgba(220, 233, 228, .8);
            background: rgba(245, 250, 248, .92);
            backdrop-filter: blur(16px);
        }

        .nav-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 76px;
            gap: 28px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 11px;
            flex-shrink: 0;
        }

        .brand img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
        }

        .brand-name {
            display: grid;
            gap: 1px;
        }

        .brand-name strong {
            font-size: .99rem;
            letter-spacing: -.03em;
        }

        .brand-name span {
            color: var(--muted);
            font-size: .65rem;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            color: #4d696d;
            font-size: .84rem;
            font-weight: 650;
        }

        .nav-links a {
            transition: color .2s ease;
        }

        .nav-links a:hover {
            color: var(--teal);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-dashboard {
            color: var(--ink);
            font-size: .82rem;
            font-weight: 700;
        }

        .nav-cta {
            min-height: 42px;
            padding-inline: 17px;
            font-size: .8rem;
        }

        .menu-toggle {
            display: none;
            width: 44px;
            height: 44px;
            place-items: center;
            border: 1px solid var(--line);
            border-radius: 50%;
            background: #fff;
            cursor: pointer;
        }

        .menu-toggle svg {
            width: 20px;
            height: 20px;
        }

        .hero {
            position: relative;
            overflow: hidden;
            padding: 64px 0 74px;
        }

        .hero::before {
            position: absolute;
            top: -230px;
            right: -170px;
            width: 690px;
            height: 690px;
            border: 1px solid rgba(22, 127, 120, .12);
            border-radius: 50%;
            content: "";
        }

        .hero::after {
            position: absolute;
            top: -155px;
            right: -95px;
            width: 540px;
            height: 540px;
            border: 1px solid rgba(22, 127, 120, .1);
            border-radius: 50%;
            content: "";
        }

        .hero-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1fr .95fr;
            align-items: center;
            gap: 62px;
        }

        .hero-copy {
            max-width: 575px;
        }

        .hero-copy .eyebrow {
            padding: 9px 13px;
            border: 1px solid #d5e9dd;
            border-radius: 999px;
            background: rgba(255, 255, 255, .62);
            font-size: .68rem;
            letter-spacing: .08em;
        }

        .hero-copy .eyebrow::before {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #75b56a;
        }

        h1 {
            margin: 23px 0 17px;
            font-size: clamp(2.85rem, 5.7vw, 5.15rem);
            line-height: .99;
            letter-spacing: -.075em;
        }

        h1 span {
            color: var(--teal);
        }

        .hero-lead {
            max-width: 480px;
            margin: 0;
            color: var(--muted);
            font-size: 1.04rem;
            line-height: 1.8;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 29px;
        }

        .hero-note {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 28px;
            color: var(--muted);
            font-size: .78rem;
        }

        .avatar-stack {
            display: flex;
            padding-left: 5px;
        }

        .avatar-stack span {
            display: grid;
            width: 28px;
            height: 28px;
            margin-left: -5px;
            place-items: center;
            border: 2px solid var(--paper);
            border-radius: 50%;
            background: var(--lime);
            font-size: .72rem;
        }

        .avatar-stack span:nth-child(2) {
            background: #c9e6d9;
        }

        .avatar-stack span:nth-child(3) {
            background: #f5d6b2;
        }

        .hero-note strong {
            color: var(--ink);
        }

        .hero-visual {
            position: relative;
            min-height: 435px;
        }

        .hero-art {
            position: absolute;
            top: 16px;
            right: 5%;
            width: min(76%, 370px);
            height: 380px;
            overflow: hidden;
            border: 10px solid rgba(255, 255, 255, .82);
            border-radius: 190px 190px 36px 36px;
            background: #d8e9dc;
            box-shadow: var(--shadow);
            transform: rotate(2deg);
        }

        .hero-art img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-sticker {
            position: absolute;
            top: 54px;
            left: 3%;
            display: grid;
            width: 100px;
            height: 100px;
            place-content: center;
            border: 5px solid var(--paper);
            border-radius: 50%;
            color: var(--deep);
            background: var(--lime);
            text-align: center;
            transform: rotate(-12deg);
        }

        .hero-sticker strong {
            font-size: 1.38rem;
            line-height: 1;
        }

        .hero-sticker span {
            margin-top: 4px;
            font-size: .59rem;
            font-weight: 800;
            text-transform: uppercase;
        }

        .float-card {
            position: absolute;
            right: 0;
            bottom: 31px;
            display: flex;
            align-items: center;
            gap: 12px;
            max-width: 236px;
            padding: 14px 17px;
            border: 1px solid rgba(220, 233, 228, .8);
            border-radius: 18px;
            background: rgba(255, 255, 255, .93);
            box-shadow: var(--shadow);
        }

        .float-icon {
            display: flex;
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            background: var(--mint);
            font-size: 1.55rem;
            line-height: 40px;
            text-align: center;
        }

        .float-card strong {
            display: block;
            font-size: .78rem;
        }

        .float-card span {
            display: block;
            margin-top: 3px;
            color: var(--muted);
            font-size: .66rem;
        }

        .hero-doodle {
            position: absolute;
            right: 0;
            bottom: 25px;
            color: rgba(22, 127, 120, .28);
            font-size: 4.5rem;
            transform: rotate(13deg);
        }

        .perks {
            padding: 0 0 84px;
        }

        .perks-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 20px;
            background: rgba(255, 255, 255, .72);
        }

        .perk {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 23px 26px;
        }

        .perk+.perk {
            border-left: 1px solid var(--line);
        }

        .perk-icon {
            display: flex;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: var(--mint);
            font-size: 1.55rem;
            line-height: 42px;
            text-align: center;
        }

        .perk strong {
            display: block;
            font-size: .85rem;
        }

        .perk span {
            display: block;
            margin-top: 4px;
            color: var(--muted);
            font-size: .73rem;
        }

        .section {
            padding: 92px 0;
        }

        .section-head {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 32px;
            margin-bottom: 34px;
        }

        .section-head h2,
        .story-copy h2,
        .order-copy h2 {
            margin: 12px 0 0;
            font-size: clamp(2rem, 3.4vw, 3.2rem);
            line-height: 1.08;
            letter-spacing: -.06em;
        }

        .section-head p {
            max-width: 390px;
            margin: 0 0 4px;
            color: var(--muted);
            font-size: .92rem;
            line-height: 1.7;
        }

        .catalog {
            background: #fff;
        }

        .filter-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 28px;
        }

        .filter-button {
            min-height: 38px;
            padding: 0 15px;
            border: 1px solid var(--line);
            border-radius: 999px;
            color: var(--muted);
            background: #fff;
            font-size: .75rem;
            font-weight: 700;
            transition: .2s ease;
            cursor: pointer;
        }

        .filter-button:hover,
        .filter-button[aria-pressed="true"] {
            border-color: var(--deep);
            color: #fff;
            background: var(--deep);
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .product-card {
            overflow: hidden;
            border: 1px solid #e8efeb;
            border-radius: 20px;
            background: #fff;
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 42px rgba(13, 51, 56, .1);
        }

        .product-card[hidden] {
            display: none;
        }

        .product-image {
            position: relative;
            display: grid;
            height: 245px;
            overflow: hidden;
            place-items: center;
            background: #e7f3ed;
        }

        .product-card:nth-child(2) .product-image {
            background: #e7eff0;
        }

        .product-card:nth-child(3) .product-image {
            background: #f3eddf;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-tag {
            position: absolute;
            top: 14px;
            left: 14px;
            padding: 7px 10px;
            border: 1px solid rgba(255, 255, 255, .7);
            border-radius: 999px;
            color: var(--ink);
            background: rgba(255, 255, 255, .86);
            font-size: .64rem;
            font-weight: 750;
            backdrop-filter: blur(8px);
        }

        .product-info {
            padding: 19px 20px 20px;
        }

        .product-info h3 {
            margin: 0;
            font-size: 1.15rem;
            letter-spacing: -.035em;
        }

        .product-info p {
            min-height: 48px;
            margin: 8px 0 17px;
            color: var(--muted);
            font-size: .8rem;
            line-height: 1.65;
        }

        .product-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding-top: 14px;
            border-top: 1px solid #edf2ef;
        }

        .product-weight {
            color: var(--muted);
            font-size: .73rem;
            font-weight: 650;
        }

        .text-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--teal);
            font-size: .77rem;
            font-weight: 800;
        }

        .text-link:hover {
            color: var(--deep);
        }

        .catalog-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 22px;
            margin-top: 25px;
            padding: 18px 20px;
            border-radius: 14px;
            background: var(--paper);
        }

        .catalog-footer p {
            margin: 0;
            color: var(--muted);
            font-size: .8rem;
        }

        .story {
            overflow: hidden;
            background: var(--mint);
        }

        .story-grid {
            display: grid;
            grid-template-columns: .9fr 1.1fr;
            align-items: center;
            gap: 82px;
        }

        .story-art {
            position: relative;
            min-height: 380px;
        }

        .story-art img {
            position: absolute;
            top: 0;
            left: 5%;
            width: 76%;
            height: 365px;
            border-radius: 28px 160px 28px 28px;
            object-fit: cover;
            box-shadow: var(--shadow);
        }

        .story-bubble {
            position: absolute;
            right: 0;
            bottom: 17px;
            display: grid;
            width: 120px;
            height: 120px;
            place-content: center;
            border: 7px solid var(--mint);
            border-radius: 50%;
            color: #fff;
            background: var(--teal);
            text-align: center;
            transform: rotate(7deg);
        }

        .story-bubble strong {
            font-size: 1.4rem;
        }

        .story-bubble span {
            font-size: .62rem;
            font-weight: 750;
        }

        .story-copy>p {
            max-width: 490px;
            margin: 17px 0 25px;
            color: #567174;
            font-size: .92rem;
            line-height: 1.8;
        }

        .story-points {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 22px;
            margin: 0 0 27px;
            padding: 0;
            list-style: none;
        }

        .story-points li {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: .79rem;
            font-weight: 700;
        }

        .check {
            display: grid;
            width: 21px;
            height: 21px;
            flex-shrink: 0;
            place-items: center;
            border-radius: 50%;
            color: var(--teal);
            background: #fff;
            font-size: .72rem;
        }

        .ordering {
            background: var(--deep);
            color: #fff;
        }

        .ordering .eyebrow {
            color: var(--lime);
        }

        .ordering .section-head p {
            color: #b7c9c6;
        }

        .ordering .section-head h2 {
            color: #fff;
        }

        .order-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .order-card {
            min-height: 210px;
            padding: 24px;
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 18px;
            background: rgba(255, 255, 255, .06);
            transition: background .2s ease, transform .2s ease;
        }

        .order-card:hover {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, .1);
        }

        .order-card img {
            width: 44px;
            height: 44px;
            margin-bottom: 20px;
            border-radius: 12px;
            background: #fff;
            object-fit: contain;
        }

        .order-card h3 {
            margin: 0 0 7px;
            font-size: 1rem;
        }

        .order-card p {
            margin: 0 0 18px;
            color: #b7c9c6;
            font-size: .77rem;
            line-height: 1.65;
        }

        .order-card .text-link {
            color: var(--lime);
        }

        .steps {
            background: #fff;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 36px;
            margin-top: 38px;
        }

        .step {
            position: relative;
            padding-top: 18px;
            border-top: 1px solid var(--line);
        }

        .step-number {
            color: var(--teal);
            font-size: .75rem;
            font-weight: 850;
            letter-spacing: .1em;
        }

        .step h3 {
            margin: 14px 0 8px;
            font-size: 1.07rem;
        }

        .step p {
            max-width: 290px;
            margin: 0;
            color: var(--muted);
            font-size: .8rem;
            line-height: 1.7;
        }

        .faq {
            padding-top: 20px;
            background: #fff;
        }

        .faq-grid {
            display: grid;
            grid-template-columns: .7fr 1.3fr;
            gap: 80px;
        }

        .faq-title h2 {
            margin: 12px 0;
            font-size: clamp(2rem, 3.1vw, 2.8rem);
            line-height: 1.08;
            letter-spacing: -.06em;
        }

        .faq-title p {
            color: var(--muted);
            font-size: .86rem;
            line-height: 1.7;
        }

        .faq-list details {
            border-bottom: 1px solid var(--line);
        }

        .faq-list summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 19px 0;
            font-size: .86rem;
            font-weight: 750;
            cursor: pointer;
            list-style: none;
        }

        .faq-list summary::-webkit-details-marker {
            display: none;
        }

        .faq-list summary::after {
            content: "+";
            color: var(--teal);
            font-size: 1.3rem;
            font-weight: 500;
        }

        .faq-list details[open] summary::after {
            content: "−";
        }

        .faq-list details p {
            margin: -4px 30px 19px 0;
            color: var(--muted);
            font-size: .81rem;
            line-height: 1.7;
        }

        .site-footer {
            padding: 54px 0 22px;
            color: #d7e5df;
            background: #09262d;
        }

        .footer-top {
            display: flex;
            justify-content: space-between;
            gap: 40px;
            padding-bottom: 36px;
        }

        .footer-brand {
            max-width: 300px;
        }

        .footer-brand .brand-name strong {
            color: #fff;
        }

        .footer-brand .brand-name span {
            color: #a7bfba;
        }

        .footer-brand p {
            margin: 16px 0 0;
            color: #a7bfba;
            font-size: .78rem;
            line-height: 1.7;
        }

        .footer-links {
            display: flex;
            align-items: flex-start;
            gap: 46px;
        }

        .footer-links div {
            display: grid;
            gap: 11px;
        }

        .footer-links strong {
            margin-bottom: 4px;
            color: #fff;
            font-size: .78rem;
        }

        .footer-links a {
            color: #b8ccc6;
            font-size: .75rem;
        }

        .footer-links a:hover {
            color: var(--lime);
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding-top: 18px;
            border-top: 1px solid rgba(255, 255, 255, .14);
            color: #91aaa5;
            font-size: .68rem;
        }

        .floating-wa {
            position: fixed;
            z-index: 18;
            right: 24px;
            bottom: 24px;
            display: grid;
            width: 56px;
            height: 56px;
            place-items: center;
            border: 4px solid rgba(255, 255, 255, .9);
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 8px 30px rgba(9, 38, 45, .2);
            transition: transform .2s ease;
        }

        .floating-wa:hover {
            transform: translateY(-4px) scale(1.04);
        }

        .floating-wa img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }

        dialog {
            width: min(510px, calc(100% - 32px));
            max-height: min(90vh, 760px);
            padding: 0;
            overflow: auto;
            border: 0;
            border-radius: 24px;
            color: var(--ink);
            background: #fff;
            box-shadow: 0 28px 90px rgba(4, 25, 30, .32);
        }

        dialog::backdrop {
            background: rgba(8, 34, 39, .66);
            backdrop-filter: blur(4px);
        }

        .dialog-image {
            height: 260px;
            overflow: hidden;
            background: var(--mint);
        }

        .dialog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .dialog-copy {
            padding: 25px;
        }

        .dialog-copy h2 {
            margin: 9px 0;
            font-size: 1.7rem;
            letter-spacing: -.05em;
        }

        .dialog-copy p {
            margin: 0 0 22px;
            color: var(--muted);
            font-size: .88rem;
            line-height: 1.75;
        }

        .dialog-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .dialog-close {
            position: absolute;
            top: 14px;
            right: 14px;
            display: grid;
            width: 38px;
            height: 38px;
            place-items: center;
            border: 0;
            border-radius: 50%;
            color: var(--ink);
            background: rgba(255, 255, 255, .92);
            font-size: 1.4rem;
            cursor: pointer;
        }

        .reveal {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity .65s ease, transform .65s ease;
        }

        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        :focus-visible {
            outline: 3px solid #8cc9a0;
            outline-offset: 3px;
        }

        @media (max-width: 900px) {
            .nav-links {
                gap: 19px;
            }

            .hero-grid {
                gap: 26px;
            }

            .hero-visual {
                min-height: 390px;
            }

            .hero-art {
                height: 340px;
            }

            .story-grid {
                gap: 45px;
            }

            .perk {
                padding-inline: 17px;
            }
        }

        @media (max-width: 720px) {
            .container {
                width: min(100% - 36px, 560px);
            }

            .nav-wrap {
                min-height: 68px;
                gap: 12px;
            }

            .menu-toggle {
                display: grid;
            }

            .nav-links {
                position: absolute;
                top: calc(100% + 1px);
                right: 0;
                left: 0;
                display: none;
                align-items: stretch;
                gap: 0;
                padding: 10px 22px 18px;
                border-bottom: 1px solid var(--line);
                background: var(--paper);
                box-shadow: 0 12px 18px rgba(13, 51, 56, .06);
            }

            .nav-links.is-open {
                display: grid;
            }

            .nav-links a {
                padding: 13px 0;
                border-bottom: 1px solid var(--line);
            }

            .nav-links a:last-child {
                border-bottom: 0;
            }

            .nav-dashboard {
                display: none;
            }

            .nav-cta {
                min-height: 40px;
                padding-inline: 13px;
                font-size: .73rem;
            }

            .brand {
                gap: 8px;
            }

            .brand img {
                width: 41px;
                height: 41px;
            }

            .brand-name strong {
                font-size: .86rem;
            }

            .brand-name span {
                font-size: .56rem;
            }

            .hero {
                padding: 48px 0 38px;
            }

            .hero-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .hero-copy {
                max-width: 520px;
            }

            h1 {
                max-width: 500px;
                font-size: clamp(3rem, 12vw, 4.7rem);
            }

            .hero-lead {
                font-size: .92rem;
            }

            .hero-visual {
                min-height: 360px;
                margin-top: 4px;
            }

            .hero-art {
                top: 6px;
                right: 13%;
                width: 68%;
                height: 320px;
            }

            .hero-sticker {
                top: 35px;
                left: 2%;
                width: 86px;
                height: 86px;
            }

            .hero-doodle {
                right: 3%;
                bottom: 26px;
                font-size: 3rem;
            }

            .float-card {
                right: 1%;
                bottom: 18px;
            }

            .perks {
                padding-bottom: 44px;
            }

            .perks-grid {
                grid-template-columns: 1fr;
            }

            .perk {
                padding: 16px 18px;
            }

            .perk+.perk {
                border-top: 1px solid var(--line);
                border-left: 0;
            }

            .section {
                padding: 68px 0;
            }

            .section-head {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
                margin-bottom: 25px;
            }

            .section-head p {
                font-size: .84rem;
            }

            .product-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .product-card {
                display: grid;
                grid-template-columns: minmax(110px, 36%) 1fr;
            }

            .product-image {
                height: 100%;
                min-height: 190px;
            }

            .product-info {
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 16px;
            }

            .product-info p {
                min-height: unset;
                margin-bottom: 13px;
                font-size: .74rem;
            }

            .product-info h3 {
                font-size: 1rem;
            }

            .product-meta {
                align-items: flex-start;
                flex-direction: column;
                gap: 8px;
                padding-top: 11px;
            }

            .catalog-footer {
                align-items: flex-start;
                flex-direction: column;
            }

            .story-grid {
                grid-template-columns: 1fr;
                gap: 34px;
            }

            .story-art {
                min-height: 310px;
            }

            .story-art img {
                left: 3%;
                width: 77%;
                height: 295px;
            }

            .story-bubble {
                width: 106px;
                height: 106px;
            }

            .story-copy>p {
                font-size: .84rem;
            }

            .story-points {
                gap: 14px 10px;
            }

            .story-points li {
                align-items: flex-start;
                font-size: .71rem;
            }

            .order-grid {
                grid-template-columns: 1fr;
                gap: 11px;
            }

            .order-card {
                min-height: unset;
                padding: 20px;
            }

            .order-card img {
                margin-bottom: 13px;
            }

            .steps-grid {
                grid-template-columns: 1fr;
                gap: 23px;
                margin-top: 27px;
            }

            .step {
                padding-top: 15px;
            }

            .faq-grid {
                grid-template-columns: 1fr;
                gap: 17px;
            }

            .faq-title p {
                max-width: 380px;
            }

            .footer-top {
                flex-direction: column;
                gap: 28px;
            }

            .footer-links {
                flex-wrap: wrap;
                gap: 30px;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 8px;
            }

            .floating-wa {
                right: 15px;
                bottom: 15px;
                width: 51px;
                height: 51px;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }

            .reveal {
                opacity: 1;
                transform: none;
            }
        }
    </style>
</head>

<body>
    <div class="announcement">Temukan pakan favorit si ikan kesayangan di <strong>Chiamonshop</strong> 🐟</div>
    <header class="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="#beranda" aria-label="Chiamonshop, kembali ke beranda">
                <img src="{{ asset('images/logo.png') }}" alt="">
                <span class="brand-name"><strong>chiamonshop</strong><span>teman makan ikanmu</span></span>
            </a>
            <button class="menu-toggle" type="button" aria-label="Buka menu" aria-expanded="false"
                aria-controls="primary-navigation">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path d="M4 7h16M4 12h16M4 17h16" stroke-linecap="round" />
                </svg>
            </button>
            <nav class="nav-links" id="primary-navigation" aria-label="Navigasi utama">
                <a href="#produk">Produk</a>
                <a href="#tentang">Kenapa Chiamon</a>
                <a href="#cara-pesan">Cara pesan</a>
                <a href="#faq">FAQ</a>
            </nav>
            <div class="nav-actions">
                @auth
                    <a class="nav-dashboard" href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a class="nav-dashboard" href="{{ route('login') }}">Masuk</a>
                @endauth
                <a class="button button-primary nav-cta" href="https://wa.me/6285157385001" target="_blank"
                    rel="noopener noreferrer">Pesan sekarang <span class="button-arrow" aria-hidden="true">↗</span></a>
            </div>
        </div>
    </header>

    <main>
        <section class="hero" id="beranda">
            <div class="container hero-grid">
                <div class="hero-copy reveal">
                    <span class="eyebrow">Pakan pilihan, ikan lebih happy</span>
                    <h1>Waktunya ikanmu makan <span>enak.</span></h1>
                    <p class="hero-lead">Pilihan pakan ikan favorit, mulai dari udang rawa hingga pakan beku. Praktis
                        dipesan, siap menemani ikan kesayanganmu tumbuh sehat.</p>
                    <div class="hero-actions">
                        <a class="button button-primary"
                            href="https://wa.me/6285157385001?text={{ urlencode('Halo Chiamonshop, saya ingin tanya tentang pakan ikan.') }}"
                            target="_blank" rel="noopener noreferrer">Yuk, tanya dulu <span class="button-arrow"
                                aria-hidden="true">↗</span></a>
                        <a class="button button-light" href="#produk">Lihat pilihan pakan <span class="button-arrow"
                                aria-hidden="true">↓</span></a>
                    </div>
                    <div class="hero-note">
                        <span class="avatar-stack"
                            aria-hidden="true"><span>🐠</span><span>🐟</span><span>🦐</span></span>
                        <span>Pesan mudah lewat <strong>WhatsApp & marketplace</strong></span>
                    </div>
                </div>
                <div class="hero-visual reveal" aria-label="Pilihan pakan Chiamonshop">
                    <div class="hero-art"><img src="{{ asset('images/udang-rawa.png') }}"
                            alt="Ilustrasi udang rawa, salah satu pilihan pakan ikan Chiamonshop"></div>
                    <div class="hero-sticker"><strong>🐟</strong><span>ikan happy</span></div>
                    <div class="float-card"><span class="float-icon" aria-hidden="true">🧊</span><span><strong>Banyak
                                pilihan pakan</strong><span>Untuk teman-teman ikanmu</span></span></div>
                    <span class="hero-doodle" aria-hidden="true">〰</span>
                </div>
            </div>
        </section>

        <section class="perks" aria-label="Keunggulan Chiamonshop">
            <div class="container perks-grid reveal">
                <div class="perk"><span class="perk-icon" aria-hidden="true">🐟</span><span><strong>Pilihan pakan
                            beragam</strong><span>Temukan pakan yang cocok untuk ikanmu</span></span></div>
                <div class="perk"><span class="perk-icon" aria-hidden="true">📦</span><span><strong>Pesan dengan
                            mudah</strong><span>Pilih kanal belanja favoritmu</span></span></div>
                <div class="perk"><span class="perk-icon" aria-hidden="true">💬</span><span><strong>Bisa tanya
                            langsung</strong><span>Hubungi kami untuk info produk</span></span></div>
            </div>
        </section>

        @php
            $feedOptions = [
                [
                    'name' => 'Udang Rawa',
                    'category' => 'alami',
                    'label' => 'Pakan alami',
                    'image' => asset('images/udang-rawa.png'),
                    'description' =>
                        'Udang rawa untuk pakan ikan predator dan arwana. Tersedia dalam kemasan 500 gram.',
                ],
                [
                    'name' => 'Cacing Beku',
                    'category' => 'beku',
                    'label' => 'Pakan beku',
                    'image' => asset('images/cacing-beku.png'),
                    'description' =>
                        'Cacing beku yang praktis sebagai pilihan pakan ikan. Tersedia dalam kemasan 500 gram.',
                ],
                [
                    'name' => 'Kutu Air',
                    'category' => 'alami',
                    'label' => 'Pakan alami',
                    'image' => asset('images/kutu-air.png'),
                    'description' => 'Kutu air untuk pilihan pakan ikan cupang. Tersedia dalam kemasan 500 gram.',
                ],
            ];
        @endphp
        <section class="section catalog" id="produk">
            <div class="container">
                <div class="section-head reveal">
                    <div><span class="eyebrow">Pilih menu si ikan</span>
                        <h2>Favorit yang bikin<br>ikan semangat makan.</h2>
                    </div>
                    <p>Kenalan dengan beberapa pilihan pakan dari Chiamonshop. Klik produknya untuk tahu lebih lanjut.
                    </p>
                </div>
                <div class="filter-list reveal" role="group" aria-label="Filter jenis pakan">
                    <button class="filter-button" type="button" data-filter="semua" aria-pressed="true">Semua
                        pakan</button>
                    <button class="filter-button" type="button" data-filter="alami" aria-pressed="false">Pakan
                        alami</button>
                    <button class="filter-button" type="button" data-filter="beku" aria-pressed="false">Pakan
                        beku</button>
                </div>
                <div class="product-grid">
                    @foreach ($feedOptions as $item)
                        <article class="product-card reveal" data-category="{{ $item['category'] }}">
                            <div class="product-image">
                                <img src="{{ $item['image'] }}"
                                    alt="{{ $item['name'] }} — ilustrasi pakan ikan Chiamonshop" loading="lazy">
                                <span class="product-tag">{{ $item['label'] }}</span>
                            </div>
                            <div class="product-info">
                                <h3>{{ $item['name'] }}</h3>
                                <p>{{ $item['description'] }}</p>
                                <div class="product-meta">
                                    <span class="product-weight">Kemasan 500 gram</span>
                                    <button class="text-link product-detail" type="button"
                                        data-title="{{ $item['name'] }}"
                                        data-description="{{ $item['description'] }}"
                                        data-image="{{ $item['image'] }}">Lihat detail <span
                                            aria-hidden="true">↗</span></button>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="catalog-footer reveal">
                    <p>Butuh rekomendasi atau mau tanya stok? Kami siap bantu.</p>
                    <a class="text-link"
                        href="https://wa.me/6285157385001?text={{ urlencode('Halo Chiamonshop, saya ingin tanya tentang pilihan pakan ikan.') }}"
                        target="_blank" rel="noopener noreferrer">Tanya lewat WhatsApp <span
                            aria-hidden="true">↗</span></a>
                </div>
            </div>
        </section>

        <section class="section story" id="tentang">
            <div class="container story-grid">
                <div class="story-art reveal">
                    <img src="{{ asset('images/kutu-air.png') }}"
                        alt="Ilustrasi kutu air, salah satu pilihan pakan dari Chiamonshop" loading="lazy">
                    <div class="story-bubble"><strong>CHIA</strong><span>MONSHOP</span></div>
                </div>
                <div class="story-copy reveal">
                    <span class="eyebrow">Dari kami untuk ikanmu</span>
                    <h2>Belanja pakan ikan jadi lebih simpel.</h2>
                    <p>Chiamonshop hadir untuk bantu kamu menemukan pakan ikan yang dibutuhkan. Lihat pilihan produk,
                        pilih cara belanja, lalu hubungi kami kalau ada yang ingin ditanyakan.</p>
                    <ul class="story-points">
                        <li><span class="check" aria-hidden="true">✓</span>Pilihan produk yang mudah dicari</li>
                        <li><span class="check" aria-hidden="true">✓</span>Pesan langsung lewat WhatsApp</li>
                        <li><span class="check" aria-hidden="true">✓</span>Tersedia di marketplace</li>
                        <li><span class="check" aria-hidden="true">✓</span>Info produk bisa ditanyakan</li>
                    </ul>
                    <a class="button button-primary" href="https://wa.me/6285157385001" target="_blank"
                        rel="noopener noreferrer">Hubungi Chiamonshop <span class="button-arrow"
                            aria-hidden="true">↗</span></a>
                </div>
            </div>
        </section>

        <section class="section ordering" id="kanal-pesan">
            <div class="container">
                <div class="section-head reveal">
                    <div><span class="eyebrow">Belanja sesuai gayamu</span>
                        <h2>Mau pesan lewat mana?</h2>
                    </div>
                    <p>Pilih kanal belanja yang paling nyaman. Untuk pesanan khusus atau jumlah banyak, chat kami
                        langsung.</p>
                </div>
                <div class="order-grid">
                    <article class="order-card reveal">
                        <img src="{{ asset('images/wa.png') }}" alt="" loading="lazy">
                        <h3>WhatsApp</h3>
                        <p>Tanya produk dan diskusikan pesanan langsung dengan kami.</p>
                        <a class="text-link" href="https://wa.me/6285157385001" target="_blank"
                            rel="noopener noreferrer">Chat sekarang <span aria-hidden="true">↗</span></a>
                    </article>
                    <article class="order-card reveal">
                        <img src="{{ asset('images/tokopedia.png') }}" alt="" loading="lazy">
                        <h3>Tokopedia</h3>
                        <p>Jelajahi produk dan lakukan pemesanan melalui toko kami.</p>
                        <a class="text-link" href="https://tokopedia.com/chiamonshop" target="_blank"
                            rel="noopener noreferrer">Kunjungi toko <span aria-hidden="true">↗</span></a>
                    </article>
                    <article class="order-card reveal">
                        <img src="{{ asset('images/tiktokshop.png') }}" alt="" loading="lazy">
                        <h3>TikTok Shop</h3>
                        <p>Temukan Chiamonshop dan belanja lewat TikTok Shop.</p>
                        <a class="text-link" href="#" target="_blank" rel="noopener noreferrer">Lihat toko
                            <span aria-hidden="true">↗</span></a>
                    </article>
                </div>
            </div>
        </section>

        <section class="section steps" id="cara-pesan">
            <div class="container">
                <div class="section-head reveal">
                    <div><span class="eyebrow">Gampang kok</span>
                        <h2>Tiga langkah menuju<br>waktu makan ikan.</h2>
                    </div>
                    <p>Pilih produk dan kanal favoritmu. Kalau masih bingung, kami bisa bantu lewat WhatsApp.</p>
                </div>
                <div class="steps-grid">
                    <article class="step reveal"><span class="step-number">LANGKAH 01</span>
                        <h3>Pilih pakan favorit</h3>
                        <p>Lihat pilihan pakan ikan yang tersedia di katalog Chiamonshop.</p>
                    </article>
                    <article class="step reveal"><span class="step-number">LANGKAH 02</span>
                        <h3>Pilih cara belanja</h3>
                        <p>Pesan melalui WhatsApp atau kunjungi toko kami di marketplace.</p>
                    </article>
                    <article class="step reveal"><span class="step-number">LANGKAH 03</span>
                        <h3>Konfirmasi pesanan</h3>
                        <p>Untuk pesanan melalui WhatsApp, diskusikan detailnya bersama tim kami.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section faq" id="faq">
            <div class="container faq-grid">
                <div class="faq-title reveal"><span class="eyebrow">Ada pertanyaan?</span>
                    <h2>Yang sering ditanyakan.</h2>
                    <p>Belum menemukan jawaban? Hubungi kami, kami senang membantu.</p>
                </div>
                <div class="faq-list reveal">
                    <details>
                        <summary>Bagaimana cara memesan produk?</summary>
                        <p>Pilih produk yang kamu inginkan, lalu hubungi kami melalui WhatsApp atau kunjungi toko
                            Chiamonshop di Tokopedia dan TikTok Shop.</p>
                    </details>
                    <details>
                        <summary>Apakah bisa pesan dalam jumlah banyak?</summary>
                        <p>Bisa. Silakan chat kami melalui WhatsApp untuk menanyakan ketersediaan dan detail pesanan.
                        </p>
                    </details>
                    <details>
                        <summary>Bagaimana cara mengetahui stok dan harga terbaru?</summary>
                        <p>Stok dan harga dapat berubah. Hubungi kami langsung atau cek halaman toko di marketplace
                            untuk informasi terbaru.</p>
                    </details>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-top">
                <div class="footer-brand">
                    <a class="brand" href="#beranda">
                        <img src="{{ asset('images/logo.png') }}" alt="">
                        <span class="brand-name"><strong>chiamonshop</strong><span>teman makan ikanmu</span></span>
                    </a>
                    <p>Pilihan pakan ikan untuk momen makan yang lebih menyenangkan. Sampai jumpa di Chiamonshop!</p>
                </div>
                <div class="footer-links">
                    <div><strong>Jelajahi</strong><a href="#produk">Pilihan pakan</a><a href="#tentang">Tentang
                            kami</a><a href="#cara-pesan">Cara pesan</a></div>
                    <div><strong>Belanja</strong><a href="https://tokopedia.com/chiamonshop" target="_blank"
                            rel="noopener noreferrer">Tokopedia ↗</a><a href="#" target="_blank"
                            rel="noopener noreferrer">TikTok Shop ↗</a><a href="https://wa.me/6285157385001"
                            target="_blank" rel="noopener noreferrer">WhatsApp ↗</a></div>
                <div><strong>Akun toko</strong>@auth<a href="{{ route('dashboard') }}">Dashboard</a>@else<a
                        href="{{ route('login') }}">Masuk</a>@endauth
                </div>
            </div>
        </div>
        <div class="footer-bottom"><span>© {{ date('Y') }} Chiamonshop. Dengan senang hati menemani
                ikanmu.</span><a href="#beranda">Kembali ke atas ↑</a></div>
    </div>
</footer>

<a class="floating-wa"
    href="https://wa.me/6285157385001?text={{ urlencode('Halo Chiamonshop, saya ingin tanya tentang pakan ikan.') }}"
    target="_blank" rel="noopener noreferrer" aria-label="Chat Chiamonshop melalui WhatsApp">
    <img src="{{ asset('images/wa.png') }}" alt="">
</a>

<dialog id="product-dialog" aria-labelledby="dialog-title">
    <button class="dialog-close" type="button" aria-label="Tutup detail produk">×</button>
    <div class="dialog-image"><img id="dialog-image" src="" alt=""></div>
    <div class="dialog-copy">
        <span class="eyebrow">Kenalan dengan produknya</span>
        <h2 id="dialog-title"></h2>
        <p id="dialog-description"></p>
        <div class="dialog-actions">
            <a class="button button-primary" id="dialog-order" href="https://wa.me/6285157385001"
                target="_blank" rel="noopener noreferrer">Tanya produk ini <span class="button-arrow"
                    aria-hidden="true">↗</span></a>
            <button class="button button-light dialog-dismiss" type="button">Nanti dulu</button>
        </div>
    </div>
</dialog>

<script>
    const menuToggle = document.querySelector('.menu-toggle');
    const navigation = document.querySelector('#primary-navigation');

    menuToggle.addEventListener('click', () => {
        const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';
        menuToggle.setAttribute('aria-expanded', String(!isOpen));
        menuToggle.setAttribute('aria-label', isOpen ? 'Buka menu' : 'Tutup menu');
        navigation.classList.toggle('is-open', !isOpen);
    });

    navigation.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            menuToggle.setAttribute('aria-expanded', 'false');
            menuToggle.setAttribute('aria-label', 'Buka menu');
            navigation.classList.remove('is-open');
        });
    });

    document.querySelectorAll('.filter-button').forEach((button) => {
        button.addEventListener('click', () => {
            const filter = button.dataset.filter;
            document.querySelectorAll('.filter-button').forEach((item) => {
                item.setAttribute('aria-pressed', String(item === button));
            });
            document.querySelectorAll('.product-card').forEach((card) => {
                card.hidden = filter !== 'semua' && card.dataset.category !== filter;
            });
        });
    });

    const productDialog = document.querySelector('#product-dialog');
    const dialogImage = document.querySelector('#dialog-image');
    const dialogTitle = document.querySelector('#dialog-title');
    const dialogDescription = document.querySelector('#dialog-description');
    const dialogOrder = document.querySelector('#dialog-order');

    document.querySelectorAll('.product-detail').forEach((button) => {
        button.addEventListener('click', () => {
            dialogTitle.textContent = button.dataset.title;
            dialogDescription.textContent = button.dataset.description;
            dialogImage.src = button.dataset.image;
            dialogImage.alt = `Ilustrasi ${button.dataset.title}`;
            dialogOrder.href =
                `https://wa.me/6285157385001?text=${encodeURIComponent(`Halo Chiamonshop, saya ingin tanya tentang ${button.dataset.title}.`)}`;
            productDialog.showModal();
        });
    });

    document.querySelector('.dialog-close').addEventListener('click', () => productDialog.close());
    document.querySelector('.dialog-dismiss').addEventListener('click', () => productDialog.close());
    productDialog.addEventListener('click', (event) => {
        if (event.target === productDialog) productDialog.close();
    });

    if ('IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12
        });
        document.querySelectorAll('.reveal').forEach((element) => revealObserver.observe(element));
    } else {
        document.querySelectorAll('.reveal').forEach((element) => element.classList.add('is-visible'));
    }
</script>
</body>

</html>
