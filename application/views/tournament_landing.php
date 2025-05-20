<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo $league['league_name']; ?> | Cricket League</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Professional Base Styles */
        :root {
            --primary-color: #1a3c5e; /* Navy Blue */
            --secondary-color: #c89b2f; /* Gold */
            --accent-color: #2b847c; /* Teal */
            --text-color: #333333; /* Dark Gray */
            --light-text: #666666; /* Medium Gray */
            --bg-color: #ffffff; /* White */
            --card-bg: #f5f5f5; /* Light Gray */
            --border-radius: 8px;
            --box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            --section-spacing: 20px;
            --color-runs: #e57373;
            --color-wickets: #4caf50;
            --color-high-score: #ff9800;
            --color-best-bowling: #2196f3;
            --color-team-high: #ab47bc;
            --color-team-low: #f06292;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
            font-size: clamp(14px, 4vw, 16px);
            padding-bottom: 70px;
        }

        /* Header Styles */
        .league-header {
            background: linear-gradient(135deg, var(--primary-color), #0e2742);
            color: #ffffff;
            padding: 12px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--box-shadow);
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            color: #ffffff;
            text-decoration: none;
            margin-bottom: 8px;
            font-size: clamp(12px, 3vw, 13px);
            padding: 5px 10px;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.15);
            transition: background-color 0.3s;
        }

        .back-btn:hover {
            background-color: rgba(255, 255, 255, 0.25);
        }

        .league-title {
            font-size: clamp(1.1rem, 4.5vw, 1.3rem);
            font-weight: 700;
            margin-bottom: 6px;
            white-space: normal;
            overflow: visible;
            text-overflow: clip;
        }

        .league-meta {
            font-size: clamp(10px, 2.8vw, 11px);
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            justify-content: flex-start;
        }

        .league-meta span {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: rgba(0, 0, 0, 0.15);
            padding: 3px 6px;
            border-radius: 3px;
        }

        .league-meta i {
            font-size: 12px;
            color: var(--secondary-color);
        }

        /* Navigation */
        .nav-scroll {
            background: var(--card-bg);
            padding: 10px 12px;
            overflow-x: auto;
            white-space: nowrap;
            position: sticky;
            top: 0;
            z-index: 90;
            box-shadow: var(--box-shadow);
            display: none;
        }

        .nav-scroll::-webkit-scrollbar {
            display: none;
        }

        .nav-link {
            display: inline-block;
            padding: 7px 14px;
            margin: 0 5px;
            background: #e0e0e0;
            color: var(--primary-color);
            border-radius: 18px;
            font-size: clamp(11px, 3vw, 12px);
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-link.active, .nav-link:hover {
            background: var(--primary-color);
            color: #ffffff;
        }

        /* Footer Styles */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: var(--card-bg);
            display: flex;
            justify-content: space-around;
            padding: 8px 0;
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }

        .footer__link {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--light-text);
            font-size: clamp(9px, 2.8vw, 10px);
            padding: 6px;
            flex: 1;
            transition: color 0.3s;
        }

        .footer__link.active, .footer__link:hover {
            color: var(--primary-color);
        }

        .footer__icon {
            font-size: clamp(16px, 4.5vw, 18px);
            margin-bottom: 3px;
        }

        /* Main Content */
        .container {
            max-width: 100%;
            padding: 12px;
            background: var(--bg-color);
        }

        .section-title {
            font-size: clamp(1.1rem, 4vw, 1.3rem);
            color: var(--primary-color);
            margin: var(--section-spacing) 0 12px;
            padding-bottom: 6px;
            border-bottom: 2px solid var(--secondary-color);
            font-weight: 600;
            position: sticky;
            top: 0;
            background: var(--bg-color);
            z-index: 50;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
            margin-bottom: var(--section-spacing);
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 12px;
            box-shadow: var(--box-shadow);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 14px rgba(0, 0, 0, 0.15);
        }

        .stat-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--accent-color);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            margin: 0 auto 8px;
        }

        .stat-title {
            font-size: clamp(12px, 3.5vw, 13px);
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .stat-value {
            font-size: clamp(11px, 3vw, 12px);
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 6px;
            background: rgba(43, 132, 124, 0.1);
            padding: 3px 6px;
            border-radius: 3px;
            position: relative;
        }

        .stat-value::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 25%;
            height: 2px;
            background: var(--secondary-color);
        }

        .stat-team {
            font-size: clamp(10px, 2.8vw, 11px);
            color: var(--light-text);
            font-weight: 500;
        }

        .see-more {
            font-size: clamp(10px, 2.8vw, 11px);
            color: var(--primary-color);
            text-decoration: none;
            display: inline-block;
            margin-top: 6px;
            font-weight: 600;
            transition: color 0.3s;
        }

        .see-more:hover {
            color: var(--secondary-color);
        }

        /* Match Cards */
        .match-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 12px;
            margin-bottom: 10px;
            box-shadow: var(--box-shadow);
            transition: transform 0.3s;
        }

        .match-card:hover {
            transform: translateY(-3px);
        }

        .team-vs {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .team-img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--accent-color);
        }

        .vs-text {
            font-weight: 600;
            color: var(--primary-color);
            font-size: clamp(12px, 3.5vw, 13px);
        }

        .match-title {
            font-size: clamp(12px, 3.5vw, 13px);
            font-weight: 600;
            text-align: center;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .match-details {
            display: grid;
            grid-template-columns: 1fr;
            gap: 6px;
            font-size: clamp(11px, 3vw, 12px);
        }

        .match-detail {
            display: flex;
            align-items: center;
            padding: 5px;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 3px;
        }

        .match-detail strong {
            margin-right: 6px;
            color: var(--primary-color);
            min-width: 55px;
            font-weight: 600;
        }

        /* Results Section */
        .results-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
            margin-bottom: var(--section-spacing);
        }

        .result-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 10px;
            box-shadow: var(--box-shadow);
            border-left: 3px solid var(--secondary-color);
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .result-card:hover {
            transform: translateY(-3px);
        }

        .result-header {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            font-size: clamp(10px, 3vw, 11px);
            color: var(--light-text);
            margin-bottom: 6px;
        }

        .result-league-info {
            font-size: clamp(12px, 3.5vw, 13px);
            font-weight: 600;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }

        .result-match-type {
            font-size: clamp(10px, 3vw, 11px);
            color: var(--light-text);
            margin-left: 6px;
        }

        .result-date-time {
            font-size: clamp(10px, 3vw, 11px);
            color: var(--light-text);
            margin-top: 3px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .result-teams-scores {
            display: flex;
            flex-direction: column;
            gap: 3px;
            font-size: clamp(11px, 3.5vw, 12px);
            font-weight: 600;
            color: var(--text-color);
        }

        .result-team-score {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 5px;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 3px;
        }

        .result-team-logo {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--accent-color);
        }

        .result-team-name {
            font-weight: 600;
            color: var(--primary-color);
            min-width: 90px;
        }

        .result-score {
            font-weight: 500;
        }

        .result-outcome {
            font-size: clamp(11px, 3.5vw, 12px);
            font-weight: 600;
            color: var(--accent-color);
            text-align: left;
            margin-top: 3px;
        }

        .view-scorecard {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-color);
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 7px 10px;
            font-size: clamp(10px, 3vw, 11px);
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.2s;
            cursor: pointer;
            width: 100%;
            max-width: 160px;
            margin: 6px auto 0;
        }

        .view-scorecard:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }

        /* Points Table Section */
        .points-section {
            margin-bottom: var(--section-spacing);
        }

        .points-guide {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 15px;
            box-shadow: var(--box-shadow);
            margin-bottom: 15px;
            font-size: clamp(12px, 3.5vw, 13px);
            transition: transform 0.3s;
        }

        .points-guide:hover {
            transform: translateY(-3px);
        }

        .points-guide h3 {
            font-size: clamp(14px, 4vw, 15px);
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .points-guide-toggle {
            font-size: clamp(11px, 3vw, 12px);
            color: var(--accent-color);
            transition: transform 0.3s;
        }

        .points-guide-toggle.active {
            transform: rotate(180deg);
        }

        .points-guide-content {
            display: none;
            line-height: 1.5;
            color: var(--text-color);
        }

        .points-guide-content.active {
            display: block;
        }

        .points-guide ul {
            list-style: none;
            padding-left: 0;
            margin: 8px 0;
        }

        .points-guide li {
            margin-bottom: 8px;
            padding-left: 20px;
            position: relative;
        }

        .points-guide li:before {
            content: "🏏";
            position: absolute;
            left: 0;
            font-size: 16px;
            line-height: 1;
        }

        .points-guide strong {
            color: var(--primary-color);
        }

        .points-table-container {
            overflow-x: auto;
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 8px;
        }

        .points-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: clamp(11px, 3vw, 12px);
        }

        .points-table th {
            background: var(--primary-color);
            color: #ffffff;
            padding: 10px;
            text-align: center;
            font-weight: 600;
            white-space: nowrap;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .points-table th:first-child {
            border-top-left-radius: var(--border-radius);
        }

        .points-table th:last-child {
            border-top-right-radius: var(--border-radius);
        }

        .points-table td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
            white-space: nowrap;
            transition: background-color 0.3s;
        }

        .points-table tr:hover {
            background-color: rgba(43, 132, 124, 0.05);
        }

        .points-table tr:nth-child(even) {
            background: #fafafa;
        }

        .points-table .team-cell {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 8px;
            text-align: left;
            padding-left: 12px;
        }

        .points-table .team-logo {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--accent-color);
        }

        .points-table .highlight {
            font-weight: 600;
            color: var(--secondary-color);
            background: rgba(200, 155, 47, 0.1);
        }

        .points-table .points {
            font-weight: 600;
            color: var(--accent-color);
        }

        .points-table .empty-state {
            text-align: center;
            padding: 15px;
            font-size: clamp(12px, 3.5vw, 13px);
            color: var(--light-text);
        }

        /* Tooltip Styles */
        .tooltip {
            position: relative;
            cursor: help;
        }

        .tooltip:hover:after {
            content: attr(title);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary-color);
            color: #ffffff;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: clamp(10px, 3vw, 11px);
            white-space: nowrap;
            z-index: 20;
            margin-bottom: 6px;
        }

        .tooltip:hover:before {
            content: "";
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            border: 5px solid transparent;
            border-top-color: var(--primary-color);
            margin-bottom: 1px;
        }

        /* Teams Section */
        .team-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 12px;
            margin-bottom: 10px;
            box-shadow: var(--box-shadow);
            transition: transform 0.3s;
        }

        .team-card:hover {
            transform: translateY(-3px);
        }

        .team-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .team-logo {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--accent-color);
            margin-right: 10px;
        }

        .team-name {
            font-size: clamp(13px, 4vw, 14px);
            font-weight: 600;
            color: var(--primary-color);
        }

        .team-name a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s;
        }

        .team-name a:hover {
            color: var(--secondary-color);
        }

        .player-stats {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .player-stat-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .player-stat {
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 12px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .player-stat:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        }

        .player-stat-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--accent-color);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            margin: 0 auto 8px;
        }

        .player-stat-title {
            font-size: clamp(11px, 3vw, 12px);
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 6px;
        }

        .player-stat-value {
            font-size: clamp(11px, 3vw, 12px);
            font-weight: 700;
            color: var(--text-color);
            background: rgba(43, 132, 124, 0.1);
            padding: 3px 6px;
            border-radius: 3px;
            margin-bottom: 6px;
            position: relative;
        }

        .player-stat-value::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 25%;
            height: 2px;
            background: var(--secondary-color);
        }

        .player-stat-value strong {
            color: var(--accent-color);
        }

        /* Rules Section */
        .rules-list {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 12px;
            box-shadow: var(--box-shadow);
            font-size: clamp(12px, 3.5vw, 13px);
        }

        .rules-list li {
            margin-bottom: 8px;
            padding-left: 16px;
            position: relative;
            line-height: 1.5;
        }

        .rules-list li:before {
            content: "•";
            color: var(--secondary-color);
            position: absolute;
            left: 0;
            font-size: 16px;
            line-height: 1;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 15px;
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            font-size: clamp(12px, 3.5vw, 13px);
            color: var(--light-text);
            margin-bottom: var(--section-spacing);
        }

        /* Mobile Optimizations */
        @media (max-width: 767px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }

            .stat-card {
                padding: 10px;
                min-height: 200px;
            }

            .stat-img {
                width: 55px;
                height: 55px;
            }

            .stat-title {
                font-size: clamp(11px, 3vw, 12px);
            }

            .stat-value {
                font-size: clamp(10px, 2.8vw, 11px);
            }

            .stat-team {
                font-size: clamp(9px, 2.5vw, 10px);
            }

            .see-more {
                font-size: clamp(9px, 2.5vw, 10px);
            }

            .result-card {
                padding: 8px;
            }

            .result-team-logo {
                width: 30px;
                height: 30px;
            }

            .result-team-name {
                min-width: 80px;
            }

            .player-stat-row {
                grid-template-columns: 1fr 1fr;
                gap: 8px;
            }

            .player-stat-img {
                width: 55px;
                height: 55px;
            }

            .match-details {
                grid-template-columns: 1fr;
            }

            .view-scorecard {
                padding: 6px;
                font-size: clamp(9px, 2.8vw, 10px);
            }

            .result-league-info {
                font-size: clamp(11px, 3.5vw, 12px);
            }

            .result-match-type {
                font-size: clamp(9px, 2.8vw, 10px);
            }

            .result-date-time {
                font-size: clamp(9px, 2.8vw, 10px);
            }

            .points-guide {
                padding: 12px;
            }

            .points-guide h3 {
                font-size: clamp(13px, 4vw, 14px);
            }

            .points-table {
                font-size: clamp(10px, 3vw, 11px);
            }

            .points-table th, .points-table td {
                padding: 6px;
            }

            .points-table .team-logo {
                width: 22px;
                height: 22px;
            }

            .points-table .team-cell {
                padding-left: 8px;
                gap: 6px;
            }
        }

        /* Desktop Optimizations */
        @media (min-width: 768px) {
            body {
                padding-bottom: 0;
            }

            .footer {
                display: none;
            }

            .nav-scroll {
                display: block;
                top: 0;
                padding: 10px 15px;
            }

            .container {
                max-width: 1000px;
                margin: 0 auto;
                padding: 15px;
            }

            .league-header {
                padding: 15px 20px;
            }

            .league-title {
                font-size: clamp(1.5rem, 3vw, 1.7rem);
            }

            .league-meta {
                font-size: clamp(11px, 2.5vw, 12px);
            }

            .league-meta span {
                padding: 4px 8px;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 12px;
            }

            .results-grid {
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }

            .section-title {
                font-size: clamp(1.2rem, 3vw, 1.4rem);
            }

            .player-stats {
                grid-template-columns: 1fr;
            }

            .player-stat-row {
                grid-template-columns: 1fr 1fr;
            }

            .player-stat-img {
                width: 70px;
                height: 70px;
            }

            .match-details {
                grid-template-columns: 1fr 1fr;
            }

            .view-scorecard {
                width: auto;
                padding: 7px 14px;
            }

            .points-table-container {
                padding: 12px;
            }

            .points-table th, .points-table td {
                padding: 12px;
            }

            .points-table .team-logo {
                width: 30px;
                height: 30px;
            }
        }
    </style>
</head>
<body>
    <header class="league-header">
        <a href="javascript:history.back()" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </a>
        <h1 class="league-title"><?php echo $league['league_name']; ?></h1>
        <div class="league-meta">
            <span><i class="fas fa-calendar-alt"></i> <?php echo $league['season']; ?></span>
            <span><i class="fas fa-map-marker-alt"></i> <?php echo $league['city']; ?>, <?php echo $league['country']; ?></span>
            <span><i class="fas fa-baseball-ball"></i> <?php echo $league['match_type']; ?></span>
            <span><i class="fas fa-clock"></i> <?php echo $league['overs']; ?> Overs</span>
            <span><i class="fas fa-stadium"></i> <?php echo $league['venue']; ?></span>
        </div>
    </header>

    <nav class="nav-scroll">
        <a href="#stats" class="nav-link">Stats</a>
        <a href="#schedule" class="nav-link">Schedule</a>
        <a href="#results" class="nav-link">Results</a>
        <a href="#points" class="nav-link">Points Table</a>
        <a href="#teams" class="nav-link">Teams</a>
        <a href="#rules" class="nav-link">Rules</a>
    </nav>

    <div class="container">
        <!-- Top Stats Section -->
        <h2 class="section-title" id="stats">
            <i class="fas fa-chart-line"></i> League Top Performers
        </h2>
        <div class="stats-grid">
            <!-- Top Batsman -->
            <div class="stat-card">
                <?php if ($league_top_scorer): ?>
                    <h3 class="stat-title"><i class="fas fa-bat"></i> Top Batsman</h3>
                    <img src="<?php echo $league_top_scorer->player_image; ?>" alt="<?php echo $league_top_scorer->playerName; ?>" class="stat-img">
                    <p class="stat-value"><?php echo $league_top_scorer->playerName; ?></p>
                    <p class="stat-team"><?php echo $league_top_scorer->total_runs; ?> Runs | <?php echo $league_top_scorer->team_name; ?></p>
                    <a href="<?php echo base_url();?>TournamentController/league_top_ten_scorer/<?php echo $league['league_id'];?>" class="see-more">
                        <i class="fas fa-arrow-right"></i> See more
                    </a>
                <?php else: ?>
                    <h3 class="stat-title">Top Batsman</h3>
                    <p class="stat-value">No data available</p>
                <?php endif; ?>
            </div>

            <!-- Top Bowler -->
            <div class="stat-card">
                <?php if ($league_top_bowler): ?>
                    <h3 class="stat-title"><i class="fas fa-bowling-ball"></i> Top Bowler</h3>
                    <img src="<?php echo $league_top_bowler->player_image; ?>" alt="<?php echo $league_top_bowler->playerName; ?>" class="stat-img">
                    <p class="stat-value"><?php echo $league_top_bowler->playerName; ?></p>
                    <p class="stat-team"><?php echo $league_top_bowler->total_wickets; ?> Wickets | <?php echo $league_top_bowler->team_name; ?></p>
                    <a href="<?php echo base_url();?>TournamentController/league_top_ten_bowler/<?php echo $league['league_id'];?>" class="see-more">
                        <i class="fas fa-arrow-right"></i> See more
                    </a>
                <?php else: ?>
                    <h3 class="stat-title">Top Bowler</h3>
                    <p class="stat-value">No data available</p>
                <?php endif; ?>
            </div>

            <!-- Highest Individual Score -->
            <div class="stat-card">
                <?php if ($league_highest_individual_score): ?>
                    <h3 class="stat-title"><i class="fas fa-star"></i> Highest Score</h3>
                    <img src="<?php echo $league_highest_individual_score->player_image; ?>" alt="<?php echo $league_highest_individual_score->playerName; ?>" class="stat-img">
                    <p class="stat-value"><?php echo $league_highest_individual_score->playerName; ?></p>
                    <p class="stat-team"><?php echo $league_highest_individual_score->highest_score; ?> Runs | <?php echo $league_highest_individual_score->team_name; ?></p>
                    <a href="<?php echo base_url();?>TournamentController/league_ten_individual_scorer/<?php echo $league['league_id'];?>" class="see-more">
                        <i class="fas fa-arrow-right"></i> See more
                    </a>
                <?php else: ?>
                    <h3 class="stat-title">Highest Score</h3>
                    <p class="stat-value">No data available</p>
                <?php endif; ?>
            </div>

            <!-- Best Bowling -->
            <div class="stat-card">
                <?php if ($league_highest_wicket_taker): ?>
                    <h3 class="stat-title"><i class="fas fa-trophy"></i> Best Bowling</h3>
                    <img src="<?php echo $league_highest_wicket_taker->player_image; ?>" alt="<?php echo $league_highest_wicket_taker->playerName; ?>" class="stat-img">
                    <p class="stat-value"><?php echo $league_highest_wicket_taker->playerName; ?></p>
                    <p class="stat-team"><?php echo $league_highest_wicket_taker->wickets; ?>/<?php echo $league_highest_wicket_taker->given_runs; ?> | <?php echo $league_highest_wicket_taker->team_name; ?></p>
                    <a href="<?php echo base_url();?>TournamentController/league_top_ten_bowler_of_match/<?php echo $league['league_id'];?>" class="see-more">
                        <i class="fas fa-arrow-right"></i> See more
                    </a>
                <?php else: ?>
                    <h3 class="stat-title">Best Bowling</h3>
                    <p class="stat-value">No data available</p>
                <?php endif; ?>
            </div>

            <!-- Highest Team Score -->
            <div class="stat-card">
                <?php if ($league_highest_team_score): ?>
                    <h3 class="stat-title"><i class="fas fa-users"></i> Highest Team Score</h3>
                    <img src="<?php echo $league_highest_team_score->team_image; ?>" alt="<?php echo $league_highest_team_score->team_name; ?>" class="stat-img">
                    <p class="stat-value"><?php echo $league_highest_team_score->team_name; ?></p>
                    <p class="stat-team"><?php echo $league_highest_team_score->highest_team_score; ?>/<?php echo $league_highest_team_score->wickets; ?> (<?php echo $league_highest_team_score->t_overs; ?> overs)</p>
                    <a href="<?php echo base_url();?>TournamentController/league_top_five_team_score/<?php echo $league['league_id'];?>" class="see-more">
                        <i class="fas fa-arrow-right"></i> See more
                    </a>
                <?php else: ?>
                    <h3 class="stat-title">Highest Team</h3>
                    <p class="stat-value">No data available</p>
                <?php endif; ?>
            </div>

            <!-- Lowest Team Score -->
            <div class="stat-card">
                <?php if ($league_lowest_team_score): ?>
                    <h3 class="stat-title"><i class="fas fa-users"></i> Lowest Team Score</h3>
                    <img src="<?php echo $league_lowest_team_score->team_image; ?>" alt="<?php echo $league_lowest_team_score->team_name; ?>" class="stat-img">
                    <p class="stat-value"><?php echo $league_lowest_team_score->team_name; ?></p>
                    <p class="stat-team"><?php echo $league_lowest_team_score->highest_team_score; ?>/<?php echo $league_lowest_team_score->wickets; ?> (<?php echo $league_lowest_team_score->t_overs; ?> overs)</p>
                    <a href="<?php echo base_url();?>TournamentController/league_lowest_five_score/<?php echo $league['league_id'];?>" class="see-more">
                        <i class="fas fa-arrow-right"></i> See more
                    </a>
                <?php else: ?>
                    <h3 class="stat-title">Lowest Team</h3>
                    <p class="stat-value">No data available</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Schedule Section -->
        <h2 class="section-title" id="schedule">
            <i class="fas fa-calendar-day"></i> Upcoming Matches
        </h2>
        <?php if (!empty($league_schedule)): ?>
            <?php foreach ($league_schedule as $schedule): ?>
                <div class="match-card">
                    <div class="team-vs">
                        <img src="<?php echo $schedule->team_one_image; ?>" alt="<?php echo $schedule->team_one_name; ?>" class="team-img">
                        <span class="vs-text">vs</span>
                        <img src="<?php echo $schedule->team_two_image; ?>" alt="<?php echo $schedule->team_two_name; ?>" class="team-img">
                    </div>
                    <h3 class="match-title"><?php echo $schedule->team_one_name; ?> vs <?php echo $schedule->team_two_name; ?></h3>
                    <div class="match-details">
                        <div class="match-detail">
                            <strong><i class="far fa-calendar"></i> Date:</strong> <?php echo date("d M Y", strtotime($schedule->match_date)); ?> |
                            <strong><i class="far fa-clock"></i> Time:</strong> <?php echo $schedule->match_time; ?> |
                            <strong><i class="fas fa-map-marker-alt"></i> Venue:</strong> <?php echo $schedule->location; ?> |
                            <strong><i class="fas fa-baseball-ball"></i> Overs:</strong> <?php echo $league['overs']; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="far fa-calendar-times fa-2x" style="margin-bottom: 10px;"></i>
                <p>No upcoming matches scheduled yet</p>
            </div>
        <?php endif; ?>

        <!-- Results Section -->
        <h2 class="section-title" id="results">
            <i class="fas fa-trophy"></i> Recent Results
        </h2>
        <div class="results-grid">
            <?php if (!empty($match_results)): ?>
                <?php foreach ($match_results as $match): ?>
                    <div class="result-card">
                        <div class="result-header">
                            <div class="result-league-info">
                                <?php echo $league['league_name']; ?>
                                <span class="result-match-type"><?php echo $league['match_type']; ?> |
                                <i class="far fa-calendar-alt"></i> <?php echo date("d M Y", strtotime($match->match_date)); ?> |
                                <i class="far fa-clock"></i> <?php echo $match->match_time; ?>
                            </div>
                        </div>
                        <div class="result-teams-scores">
                            <div class="result-team-score">
                                <img src="<?php echo $match->win_team_image; ?>" alt="<?php echo $match->win_team_name; ?>" class="result-team-logo">
                                <span class="result-team-name"><?php echo $match->win_team_name; ?>:</span>
                                <span class="result-score"><?php echo $match->total_runs_batting_order_1; ?>-<?php echo $match->wickets_batting_order_1; ?> (<?php echo $match->total_overs_batting_order_1; ?>)</span>
                            </div>
                            <div class="result-team-score">
                                <img src="<?php echo $match->lost_team_image; ?>" alt="<?php echo $match->lost_team_name; ?>" class="result-team-logo">
                                <span class="result-team-name"><?php echo $match->lost_team_name; ?>:</span>
                                <span class="result-score"><?php echo $match->total_runs_batting_order_2; ?>-<?php echo $match->wickets_batting_order_2; ?> (<?php echo $match->total_overs_batting_order_2; ?>)</span>
                            </div>
                        </div>
                        <div class="result-outcome">
                            <?php echo $match->result_statement; ?>
                        </div>
                        <a href="<?php echo base_url(); ?>Welcome/scorecard/<?php echo $match->win_team;?>/<?php echo $match->lost_team; ?>/<?php echo $match->match_id; ?>" class="view-scorecard">
                            <i class="fas fa-file-alt"></i> View Full Scorecard
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i class="far fa-frown fa-2x" style="margin-bottom: 10px;"></i>
                    <p>No match results available yet</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Points Table Section -->
        <div class="points-section">
            <h2 class="section-title" id="points">
                <i class="fas fa-table"></i> Points Table
            </h2>
            <div class="points-guide">
                <h3>
                    Understanding the Points Table
                    <span class="points-guide-toggle"><i class="fas fa-chevron-down"></i></span>
                </h3>
                <div class="points-guide-content">
                    <p>The points table ranks teams based on their performance in the league:</p>
                    <ul>
                        <li><strong>Points</strong>: Earn <strong>2 points</strong> for a win, <strong>1 point</strong> for a no-result match (e.g., abandoned due to rain), and <strong>0 points</strong> for a loss.</li>
                        <li><strong>Net Run Rate (NRR)</strong>: Measures scoring efficiency. It's calculated as: <br>
                            <code>NRR = (Total Runs Scored ÷ Total Overs Faced) - (Total Runs Conceded ÷ Total Overs Bowled)</code><br>
                            A higher NRR means a team scores faster or concedes slower, used to break ties when points are equal.</li>
                        <li><strong>Ranking</strong>: Teams with more points rank higher. If points are tied, NRR determines the order.</li>
                    </ul>
                    <p>Follow your team's progress to see if they qualify for the playoffs!</p>
                </div>
            </div>
            <div class="points-table-container">
                <table class="points-table">
                    <thead>
                        <tr>
                            <th class="tooltip" title="Position in the League">#</th>
                            <th class="tooltip" title="Team Name">Team</th>
                            <th class="tooltip" title="Matches Played">P</th>
                            <th class="tooltip" title="Matches Won">W</th>
                            <th class="tooltip" title="Matches Lost">L</th>
                            <th class="tooltip" title="No Result Matches">NR</th>
                            <th class="tooltip" title="Total Points">Pts</th>
                            <th class="tooltip" title="Net Run Rate">NRR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($points_table)): ?>
                            <?php foreach ($points_table as $index => $team): ?>
                                <tr>
                                    <td class="<?php echo $index < 4 ? 'highlight' : ''; ?>"><?php echo $index + 1; ?></td>
                                    <td class="team-cell">
                                        <img src="<?php echo $team->team_image; ?>" alt="<?php echo $team->team_name; ?>" class="team-logo">
                                        <span><?php echo $team->team_name; ?></span>
                                    </td>
                                    <td><?php echo $team->matches_played; ?></td>
                                    <td><?php echo $team->wins; ?></td>
                                    <td><?php echo $team->losses; ?></td>
                                    <td><?php echo $team->no_results; ?></td>
                                    <td class="points"><?php echo $team->points; ?></td>
                                    <td><?php echo number_format($team->net_run_rate, 3); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="empty-state">
                                    <i class="far fa-frown" style="margin-right: 5px;"></i>
                                    No points data available
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Teams Section -->
        <h2 class="section-title" id="teams">
            <i class="fas fa-users"></i> Teams
        </h2>
        <?php if (!empty($league_teams) && is_array($league_teams)): ?>
            <?php foreach ($league_teams as $team): ?>
                <?php if (!empty($team) && (isset($team['team_info']) || isset($team['top_scorer']) || isset($team['top_bowler']))): ?>
                    <div class="team-card">
                        <div class="team-header">
                            <?php $team_image = isset($team['team_info']['team_image']) ? $team['team_info']['team_image'] : base_url('assets/images/default-team.png'); ?>
                            <img src="<?php echo $team_image; ?>" alt="Team Logo" class="team-logo">
                            <h3 class="team-name">
                                <?php if (isset($team['team_info']['team_id']) && isset($team['team_info']['team_name'])): ?>
                                    <a href="<?php echo base_url(); ?>TeamController/team_profile/<?php echo $team['team_info']['team_id']; ?>">
                                        <?php echo $team['team_info']['team_name']; ?>
                                    </a>
                                <?php else: ?>
                                    Team
                                <?php endif; ?>
                            </h3>
                        </div>
                        <div class="player-stats">
                            <!-- Row 1: Top Batsman and Highest Score -->
                            <div class="player-stat-row">
                                <!-- Top Batsman -->
                                <div class="player-stat">
                                    <h4 class="player-stat-title">Top Batsman</h4>
                                    <?php if (isset($team['top_scorer']) && !empty($team['top_scorer'])): ?>
                                        <?php $batsman_image = isset($team['top_scorer']['player_image']) ? $team['top_scorer']['player_image'] : base_url('assets/images/default-player.png'); ?>
                                        <img src="<?php echo $batsman_image; ?>" alt="Top Batsman" class="player-stat-img">
                                        <p class="player-stat-value"><?php echo $team['top_scorer']['player_name'] ?? 'N/A'; ?></p>
                                        <p class="player-stat-value"><strong><?php echo $team['top_scorer']['total_runs'] ?? '0'; ?> runs</strong></p>
                                    <?php else: ?>
                                        <p class="stat-value">No data available</p>
                                    <?php endif; ?>
                                </div>
                                <!-- Highest Score -->
                                <div class="player-stat">
                                    <h4 class="player-stat-title">Highest Score</h4>
                                    <?php if (isset($team['highest_individual_score']) && !empty($team['highest_individual_score'])): ?>
                                        <?php $hs_image = isset($team['highest_individual_score']['player_image']) ? $team['highest_individual_score']['player_image'] : base_url('assets/images/default-player.png'); ?>
                                        <img src="<?php echo $hs_image; ?>" alt="Highest Score" class="player-stat-img">
                                        <p class="player-stat-value"><?php echo $team['highest_individual_score']['player_name'] ?? 'N/A'; ?></p>
                                        <p class="player-stat-value"><strong><?php echo $team['highest_individual_score']['runs'] ?? '0'; ?> runs</strong></p>
                                    <?php else: ?>
                                        <p class="stat-value">No data available</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- Row 2: Top Bowler and Best Bowling -->
                            <div class="player-stat-row">
                                <!-- Top Bowler -->
                                <div class="player-stat">
                                    <h4 class="player-stat-title">Top Bowler</h4>
                                    <?php if (isset($team['top_bowler']) && !empty($team['top_bowler'])): ?>
                                        <?php $bowler_image = isset($team['top_bowler_image']) ? $team['top_bowler_image'] : base_url('assets/images/default-player.png'); ?>
                                        <img src="<?php echo $bowler_image; ?>" alt="Top Bowler" class="player-stat-img">
                                        <p class="player-stat-value"><?php echo $team['top_bowler'] ?? 'N/A'; ?></p>
                                        <p class="player-stat-value"><strong><?php echo $team['top_bowler_wickets'] ?? '0'; ?> wickets</strong></p>
                                    <?php else: ?>
                                        <p class="stat-value">No data available</p>
                                    <?php endif; ?>
                                </div>
                                <!-- Best Bowling -->
                                <div class="player-stat">
                                    <h4 class="player-stat-title">Best Bowling</h4>
                                    <?php if (isset($team['best_bowler']) && !empty($team['best_bowler'])): ?>
                                        <?php $best_bowler_image = isset($team['best_bowling_image']) ? $team['best_bowling_image'] : base_url('assets/images/default-player.png'); ?>
                                        <img src="<?php echo $best_bowler_image; ?>" alt="Best Bowling" class="player-stat-img">
                                        <p class="player-stat-value"><?php echo $team['best_bowler'] ?? 'N/A'; ?></p>
                                        <p class="player-stat-value"><strong><?php echo $team['best_bowling_figures'] ?? 'N/A'; ?></strong></p>
                                    <?php else: ?>
                                        <p class="stat-value">No data available</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if (empty(array_filter($league_teams))): ?>
                <div class="empty-state">
                    <i class="fas fa-user-slash fa-2x" style="margin-bottom: 10px;"></i>
                    <p>No teams registered yet</p>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-user-slash fa-2x" style="margin-bottom: 10px;"></i>
                <p>No teams registered yet</p>
            </div>
        <?php endif; ?>

        <!-- Rules Section -->
        <h2 class="section-title" id="rules">
            <i class="fas fa-book"></i> League Rules
        </h2>
        <div class="rules-list">
            <?php if (!empty($league_rules)): ?>
                <ul>
                    <?php foreach ($league_rules as $rule): ?>
                        <li><?php echo $rule->league_rule; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-exclamation-circle fa-2x" style="margin-bottom: 10px;"></i>
                    <p>No rules specified yet</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer (Mobile Only) -->
    <footer class="footer">
        <a href="<?php echo base_url(); ?>Welcome/landing_page" class="footer__link <?php echo current_url() == base_url('Welcome/landing_page') ? 'active' : ''; ?>" aria-label="Go to Home page">
            <i class="fas fa-home footer__icon"></i>
            <span>Home</span>
        </a>
        <?php if ($this->session->userdata('user_id') == $league['user_id']): ?>
            <a href="<?php echo base_url(); ?>Welcome/tournament_main/<?php echo htmlspecialchars($league['league_id']); ?>" class="footer__link <?php echo strpos(current_url(), 'tournament_main') !== false ? 'active' : ''; ?>" aria-label="Go to League Dashboard">
                <i class="fas fa-tachometer-alt footer__icon"></i>
                <span>Dashboard</span>
            </a>
        <?php endif; ?>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navigation handling
            const navItems = document.querySelectorAll('.footer__link, .nav-link');
            const sections = document.querySelectorAll('section[id], .section-title');
            
            function highlightNav() {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    if (window.scrollY >= (sectionTop - 150)) {
                        current = section.getAttribute('id');
                    }
                });
                
                navItems.forEach(item => {
                    item.classList.remove('active');
                    if (item.getAttribute('href') === `#${current}`) {
                        item.classList.add('active');
                    }
                });
            }
            
            window.addEventListener('scroll', highlightNav);
            highlightNav();
            
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 120,
                            behavior: 'smooth'
                        });
                        history.pushState(null, null, targetId);
                    }
                });
            });
            
            // Responsive navigation
            function checkScreenSize() {
                const footer = document.querySelector('.footer');
                const horizontalNav = document.querySelector('.nav-scroll');
                
                if (window.innerWidth >= 768) {
                    footer.style.display = 'none';
                    horizontalNav.style.display = 'block';
                } else {
                    footer.style.display = 'flex';
                    horizontalNav.style.display = 'none';
                }
            }
            
            window.addEventListener('resize', checkScreenSize);
            checkScreenSize();
            
            // Intersection Observer for subtle fade-in
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.stats-grid, .match-card, .result-card, .team-card, .points-section, .rules-list').forEach(section => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(15px)';
                section.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(section);
            });

            // Toggle Points Table Guide
            const toggle = document.querySelector('.points-guide-toggle');
            const content = document.querySelector('.points-guide-content');
            if (toggle && content) {
                toggle.addEventListener('click', function() {
                    content.classList.toggle('active');
                    toggle.classList.toggle('active');
                    const icon = toggle.querySelector('i');
                    icon.classList.toggle('fa-chevron-down');
                    icon.classList.toggle('fa-chevron-up');
                });
            }
        });
    </script>
</body>
</html>