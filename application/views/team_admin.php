<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Team Management Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Base Styles - Mobile First */
        :root {
            --primary-color: #3498db;
            --primary-hover: #2980b9;
            --success-color: #2ecc71;
            --success-hover: #27ae60;
            --danger-color: #e74c3c;
            --danger-hover: #c0392b;
            --warning-color: #f39c12;
            --warning-hover: #e67e22;
            --text-color: #333;
            --light-text: #666;
            --lighter-text: #999;
            --border-color: #e1e1e1;
            --card-bg: #fff;
            --section-bg: #f9f9f9;
            --external-color: #8e44ad;
            --external-hover: #7d3c98;
            --internal-color: #16a085;
            --internal-hover: #138a72;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --radius-sm: 6px;
            --radius-md: 8px;
            --radius-lg: 12px;
            --transition: all 0.2s ease;
            --match-upcoming: #3498db;
            --match-live: #e74c3c;
            --match-completed: #2ecc71;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            margin: 0;
            padding: 0;
            color: var(--text-color);
            font-size: 15px;
            line-height: 1.5;
            background-color: #f5f5f5;
            -webkit-font-smoothing: antialiased;
        }
        
        .tm-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 10px;
        }
        
        /* Header */
        .tm-header {
            background-color: var(--card-bg);
            padding: 15px;
            border-radius: var(--radius-md);
            margin-bottom: 12px;
            box-shadow: var(--shadow-sm);
            position: relative;
            border-left: 4px solid var(--primary-color);
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .tm-header-logo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: var(--shadow-sm);
        }
        
        .tm-header-content {
            flex: 1;
            min-width: 0;
        }
        
        .tm-header h1 {
            font-size: 1.5em;
            margin: 0;
            color: var(--text-color);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 600;
        }
        
        .tm-header p {
            font-size: 0.9em;
            color: var(--light-text);
            margin: 5px 0 0;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .tm-header p i {
            font-size: 0.9em;
        }
        
        .tm-social-links {
            display: flex;
            gap: 10px;
            margin-top: 8px;
        }
        
        .tm-social-link {
            color: var(--light-text);
            font-size: 1.1em;
            transition: var(--transition);
        }
        
        .tm-social-link:hover {
            color: var(--primary-color);
        }
        
        /* Navigation - Horizontal Scroll for Mobile */
        .tm-nav-container {
            position: sticky;
            top: 0;
            background: white;
            z-index: 100;
            padding: 8px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            margin-bottom: 12px;
        }
        
        .tm-nav {
            display: flex;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            padding: 5px 0;
        }
        
        .tm-nav::-webkit-scrollbar {
            display: none;
        }
        
        .tm-nav-item {
            flex: 0 0 auto;
            padding: 8px 14px;
            margin: 0 5px;
            font-size: 14px;
            color: var(--text-color);
            text-decoration: none;
            border-radius: 20px;
            background-color: #f0f0f0;
            white-space: nowrap;
            transition: var(--transition);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .tm-nav-item i {
            font-size: 14px;
        }
        
        .tm-nav-item.active, .tm-nav-item:hover {
            background-color: var(--primary-color);
            color: white;
            box-shadow: var(--shadow-sm);
        }
        
        /* External/Internal Links */
        .external-link {
            background-color: var(--external-color);
            color: white;
        }
        
        .external-link:hover {
            background-color: var(--external-hover);
        }
        
        .internal-link {
            background-color: var(--internal-color);
            color: white;
        }
        
        .internal-link:hover {
            background-color: var(--internal-hover);
        }
        
        /* Badges */
        .tm-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 18px;
            height: 18px;
            background: var(--danger-color);
            color: white;
            font-size: 11px;
            padding: 0 5px;
            border-radius: 10px;
            margin-left: 5px;
            font-weight: bold;
            vertical-align: middle;
        }
        
        /* Sections */
        .tm-section {
            background: var(--card-bg);
            border-radius: var(--radius-md);
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: var(--shadow-sm);
            border-top: 1px solid rgba(0,0,0,0.03);
        }
        
        .tm-section-title {
            font-size: 1.2em;
            margin: 0 0 15px;
            color: var(--text-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .tm-section-title .tm-btn {
            font-size: 0.85em;
            padding: 5px 10px;
        }
        
        .tm-section-actions {
            display: flex;
            gap: 8px;
        }
        
        /* Filter Controls */
        .tm-filter-controls {
            display: flex;
            gap: 8px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }
        
        .tm-filter-btn {
            padding: 6px 12px;
            font-size: 12px;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            background: white;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .tm-filter-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .tm-filter-btn:hover:not(.active) {
            background: rgba(0,0,0,0.05);
        }
        
        /* Cards - Compact Layout */
        .tm-card {
            display: grid;
            grid-template-columns: 45px 1fr auto;
            gap: 10px;
            align-items: center;
            padding: 10px;
            margin-bottom: 8px;
            border-radius: var(--radius-sm);
            background-color: var(--section-bg);
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .tm-card:hover {
            box-shadow: var(--shadow-sm);
            transform: translateY(-2px);
        }
        
        .tm-card:last-child {
            margin-bottom: 0;
        }
        
        .tm-card-img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: var(--shadow-sm);
        }
        
        .tm-card-content {
            overflow: hidden;
        }
        
        .tm-card-content h4 {
            margin: 0;
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 500;
        }
        
        .tm-card-content p {
            margin: 3px 0 0;
            font-size: 13px;
            color: var(--light-text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .tm-card-meta {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: var(--lighter-text);
            margin-top: 5px;
        }
        
        .tm-card-meta i {
            font-size: 10px;
        }
        
        /* Button Group */
        .tm-btn-group {
            display: flex;
            gap: 8px;
        }
        
        /* Buttons */
        .tm-btn {
            padding: 7px 12px;
            font-size: 13px;
            border: none;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        
        .tm-btn i {
            font-size: 14px;
        }
        
        .tm-btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }
        
        .tm-btn-xs {
            padding: 4px 8px;
            font-size: 11px;
        }
        
        .tm-btn-primary {
            background: var(--primary-color);
            color: white;
        }
        
        .tm-btn-primary:hover {
            background: var(--primary-hover);
            box-shadow: var(--shadow-sm);
        }
        
        .tm-btn-success {
            background: var(--success-color);
            color: white;
        }
        
        .tm-btn-success:hover {
            background: var(--success-hover);
            box-shadow: var(--shadow-sm);
        }
        
        .tm-btn-danger {
            background: var(--danger-color);
            color: white;
        }
        
        .tm-btn-danger:hover {
            background: var(--danger-hover);
            box-shadow: var(--shadow-sm);
        }
        
        .tm-btn-warning {
            background: var(--warning-color);
            color: white;
        }
        
        .tm-btn-warning:hover {
            background: var(--warning-hover);
            box-shadow: var(--shadow-sm);
        }
        
        .tm-btn-outline {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-color);
        }
        
        .tm-btn-outline:hover {
            background: rgba(0,0,0,0.03);
        }
        
        /* Info Items */
        .tm-info-item {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border-color);
            align-items: center;
        }
        
        .tm-info-item:last-child {
            border-bottom: none;
        }
        
        .tm-info-item div {
            font-size: 14px;
        }
        
        .tm-info-item strong {
            font-weight: 500;
            color: var(--text-color);
        }
        
        /* Captain Cards */
        .tm-captain-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
        }
        
        .tm-captain-card {
            text-align: center;
            padding: 15px;
            background: var(--section-bg);
            border-radius: var(--radius-md);
            border: 1px solid rgba(0,0,0,0.05);
            transition: var(--transition);
            position: relative;
        }
        
        .tm-captain-card:hover {
            box-shadow: var(--shadow-sm);
            transform: translateY(-3px);
        }
        
        .tm-captain-card h4 {
            margin: 0 0 10px;
            font-size: 15px;
            font-weight: 500;
            color: var(--text-color);
        }
        
        .tm-captain-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 8px;
            border: 3px solid white;
            box-shadow: var(--shadow-sm);
        }
        
        .tm-captain-card p {
            margin: 5px 0;
            font-size: 14px;
            font-weight: 500;
        }
        
        .tm-captain-stats {
            font-size: 11px;
            color: var(--light-text);
            margin-top: 5px;
        }
        
        /* Empty State */
        .tm-empty-state {
            text-align: center;
            padding: 20px;
            color: var(--lighter-text);
            font-size: 14px;
        }

        /* Schedule Line Improvements */
        .tm-schedule-line {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: var(--section-bg);
            border-radius: var(--radius-sm);
            border: 1px solid rgba(0,0,0,0.05);
            margin-bottom: 8px;
            gap: 10px;
            flex-wrap: wrap;
            transition: var(--transition);
        }

        .tm-schedule-line:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        .tm-schedule-line.admin-match {
            border-left: 3px solid var(--warning-color);
        }

        .tm-schedule-status {
            position: absolute;
            top: -6px;
            right: 10px;
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .tm-schedule-status.upcoming {
            background: var(--match-upcoming);
            color: white;
        }

        .tm-schedule-status.live {
            background: var(--match-live);
            color: white;
            animation: pulse 1.5s infinite;
        }

        .tm-schedule-status.completed {
            background: var(--match-completed);
            color: white;
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.6; }
            100% { opacity: 1; }
        }

        .tm-schedule-teams {
            display: flex;
            align-items: center;
            flex: 1;
            min-width: 0;
            gap: 6px;
        }

        .tm-schedule-team {
            display: flex;
            align-items: center;
            flex: 1;
            min-width: 0;
            position: relative;
        }

        .tm-schedule-team.your-team {
            font-weight: 600;
        }

        .tm-team-you {
            font-size: 10px;
            color: var(--primary-color);
            margin-left: 4px;
            white-space: nowrap;
        }

        .tm-schedule-team img {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            margin-right: 8px;
            object-fit: cover;
            border: 1px solid white;
            flex-shrink: 0;
        }

        .tm-schedule-team span {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 13px;
        }

        .tm-schedule-vs {
            margin: 0 4px;
            font-weight: bold;
            font-size: 12px;
            color: var(--light-text);
            flex-shrink: 0;
        }

        .tm-schedule-meta {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            min-width: 80px;
            font-size: 12px;
            flex-shrink: 0;
        }

        .tm-schedule-date {
            font-weight: 500;
            color: var(--text-color);
        }

        .tm-schedule-time {
            color: var(--light-text);
        }

        .tm-schedule-venue {
            font-size: 11px;
            color: var(--light-text);
            margin-top: 3px;
            white-space: nowrap;
        }

        .tm-schedule-actions {
            display: flex;
            gap: 6px;
            flex-shrink: 0;
        }

        .tm-admin-actions {
            display: flex;
            gap: 6px;
        }

        /* Team Management Specific Styles */
        .team-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .team-row {
            background: var(--section-bg);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            padding: 12px;
            transition: var(--transition);
            position: relative;
        }

        .team-row:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-sm);
        }

        .team-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
            border: 2px solid white;
            box-shadow: var(--shadow-sm);
        }

        .team-info {
            flex: 1;
            min-width: 0;
        }

        .team-info h3 {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-weight: 500;
            font-size: 14px;
            color: var(--text-color);
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .team-info p {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-weight: 400;
            font-size: 13px;
            color: var(--light-text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .team-contact {
            display: flex;
            gap: 8px;
            margin-top: 5px;
        }

        .team-contact a {
            color: var(--light-text);
            font-size: 12px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        .team-contact a:hover {
            color: var(--primary-color);
        }

        .team-contact i {
            font-size: 12px;
        }

        .insert-section {
            text-align: center;
            margin-bottom: 15px;
        }

        .insert-section button {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }

        .insert-section button:hover {
            background: var(--primary-hover);
            box-shadow: var(--shadow-sm);
        }

        .insert-section button i {
            font-size: 14px;
        }

        .team-row button {
            display: flex;
            align-items: center;
            gap: 4px;
            background: var(--warning-color);
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
        }

        .team-row button:hover {
            background: var(--warning-hover);
            box-shadow: var(--shadow-sm);
        }

        .team-row button i {
            font-size: 12px;
        }

        /* Stats Cards */
        .tm-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
            margin-bottom: 15px;
        }

        .tm-stat-card {
            background: var(--section-bg);
            border-radius: var(--radius-sm);
            padding: 12px;
            text-align: center;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .tm-stat-value {
            font-size: 1.5em;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 3px;
        }

        .tm-stat-label {
            font-size: 12px;
            color: var(--light-text);
        }

        /* Loading States */
        .tm-loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .tm-loading-text {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* Toast Notifications */
        .tm-toast {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0,0,0,0.8);
            color: white;
            padding: 12px 20px;
            border-radius: var(--radius-sm);
            font-size: 14px;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 8px;
            animation: tmToastFadeIn 0.3s ease;
            max-width: 90%;
        }

        .tm-toast.success {
            background: var(--success-color);
        }

        .tm-toast.error {
            background: var(--danger-color);
        }

        .tm-toast.warning {
            background: var(--warning-color);
        }

        @keyframes tmToastFadeIn {
            from { opacity: 0; transform: translateX(-50%) translateY(20px); }
            to { opacity: 1; transform: translateX(-50%) translateY(0); }
        }

        /* Team Management Modal */
        .tm-management-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            overflow-y: auto;
            padding: 20px 0;
            backdrop-filter: blur(3px);
        }

        .tm-management-modal-content {
            background: var(--card-bg);
            padding: 20px;
            border-radius: var(--radius-md);
            width: 90%;
            max-width: 400px;
            margin: 20px auto;
            position: relative;
            box-shadow: var(--shadow-md);
            animation: tmModalFadeIn 0.3s ease;
        }

        .tm-management-modal-header {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .tm-management-modal-header h3 {
            margin: 0;
            font-size: 1.2em;
            font-weight: 600;
            color: var(--text-color);
        }

        .tm-management-modal-close {
            font-size: 1.5em;
            cursor: pointer;
            color: var(--light-text);
            transition: var(--transition);
            padding: 5px;
            line-height: 1;
        }

        .tm-management-modal-close:hover {
            color: var(--danger-color);
        }

        .tm-management-form-group {
            margin-bottom: 15px;
        }

        .tm-management-form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--text-color);
            font-weight: 500;
        }

        .tm-management-form-group input,
        .tm-management-form-group select,
        .tm-management-form-group textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-size: 14px;
            transition: var(--transition);
        }

        .tm-management-form-group input:focus,
        .tm-management-form-group select:focus,
        .tm-management-form-group textarea:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .tm-management-form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .tm-photo-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 15px;
        }

        .tm-photo-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: var(--shadow-sm);
            margin-bottom: 10px;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--light-text);
        }

        .tm-photo-upload-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            padding: 8px 15px;
            font-size: 13px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .tm-photo-upload-btn:hover {
            background: var(--primary-hover);
        }

        /* Confirmation Modal */
        .tm-confirm-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            overflow-y: auto;
            padding: 20px 0;
            backdrop-filter: blur(3px);
        }

        .tm-confirm-modal-content {
            background: var(--card-bg);
            padding: 20px;
            border-radius: var(--radius-md);
            width: 90%;
            max-width: 400px;
            margin: 20px auto;
            position: relative;
            box-shadow: var(--shadow-md);
            animation: tmModalFadeIn 0.3s ease;
            text-align: center;
        }

        .tm-confirm-icon {
            font-size: 3em;
            color: var(--danger-color);
            margin-bottom: 15px;
        }

        .tm-confirm-text {
            margin-bottom: 20px;
            font-size: 15px;
            line-height: 1.4;
        }

        .tm-confirm-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        /* Modals (for Team Information) */
        .tm-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            overflow-y: auto;
            padding: 20px 0;
            backdrop-filter: blur(3px);
        }
        
        .tm-modal-content {
            background: white;
            padding: 20px;
            border-radius: var(--radius-md);
            width: 90%;
            max-width: 500px;
            margin: 20px auto;
            position: relative;
            box-shadow: var(--shadow-md);
            animation: tmModalFadeIn 0.3s ease;
        }
        
        @keyframes tmModalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .tm-modal-header {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .tm-modal-header h3 {
            margin: 0;
            font-size: 1.2em;
            font-weight: 600;
        }
        
        .tm-modal-close {
            font-size: 1.5em;
            cursor: pointer;
            color: var(--light-text);
            transition: var(--transition);
            padding: 5px;
            line-height: 1;
        }
        
        .tm-modal-close:hover {
            color: var(--danger-color);
        }
        
        .tm-form-group {
            margin-bottom: 15px;
        }
        
        .tm-form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: var(--text-color);
            font-weight: 500;
        }
        
        .tm-form-group input, 
        .tm-form-group select, 
        .tm-form-group textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-size: 14px;
            transition: var(--transition);
        }
        
        .tm-form-group input:focus, 
        .tm-form-group select:focus, 
        .tm-form-group textarea:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        
        .tm-form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }
        
        /* Admin Specific Styles */
        .admin-only {
            border-left: 3px solid var(--warning-color);
            position: relative;
        }
        
        .admin-only:after {
            content: "Admin";
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--warning-color);
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
            font-weight: bold;
        }
        
        /* Responsive Adjustments */
        @media (min-width: 768px) {
            .tm-container {
                max-width: 900px;
                padding: 15px;
            }
            
            .tm-header {
                padding: 18px;
            }
            
            .tm-header h1 {
                font-size: 1.7em;
            }
            
            .tm-nav-item {
                padding: 8px 18px;
                margin: 0 8px;
                font-size: 15px;
            }
            
            .tm-section {
                padding: 18px;
                margin-bottom: 18px;
            }
            
            .tm-captain-grid {
                grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
                gap: 15px;
            }
            
            .tm-captain-card {
                padding: 18px;
            }

            .tm-stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        }

        @media (max-width: 480px) {
            .tm-schedule-line {
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
            }
            
            .tm-schedule-meta {
                flex-direction: row;
                align-items: center;
                gap: 10px;
                min-width: auto;
            }
            
            .tm-schedule-actions {
                justify-content: flex-end;
                margin-top: 5px;
            }
            
            .tm-schedule-team {
                min-width: calc(50% - 20px);
            }
            
            .tm-team-you {
                position: absolute;
                left: 0;
                bottom: -14px;
                font-size: 9px;
                margin-left: 36px;
            }

            .team-row {
                padding: 10px;
            }

            .team-info h3 {
                font-size: 13px;
            }

            .team-info p {
                font-size: 12px;
            }

            .team-row button {
                font-size: 11px;
                padding: 4px 8px;
            }

            .insert-section button {
                font-size: 12px;
                padding: 7px 14px;
            }

            .tm-management-modal-content {
                width: 95%;
                padding: 15px;
            }

            .tm-confirm-modal-content {
                width: 95%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="tm-container">
        <header class="tm-header">
            <img src="<?php echo $data['image_path'];?>" alt="Team Logo" class="tm-header-logo">
            <div class="tm-header-content">
                <h1><?php echo $data['team_name']; ?></h1>
                <p><i class="fas fa-calendar-alt"></i> Est. <?php echo date('Y', strtotime($data['created_at'])); ?></p>
                <div class="tm-social-links">
                    <a href="#" class="tm-social-link" title="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="tm-social-link" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="tm-social-link" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="tm-social-link" title="Website"><i class="fas fa-globe"></i></a>
                </div>
            </div>
        </header>
          <?php if ($this->session->flashdata('message')): ?>
            <div class="flashdata-message <?php echo $this->session->flashdata('message_type'); ?>">
                <?php echo $this->session->flashdata('message'); ?>
            </div>
        <?php endif; ?>
        <div class="tm-nav-container">
            <div class="tm-nav">
                <a href="<?php echo base_url();?>Welcome/landing_page" class="tm-nav-item"><i class="fas fa-home"></i> Home</a>
                <a href="<?php echo base_url();?>TeamController/team_profile/<?php echo $team_id;?>" class="tm-nav-item internal-link"><i class="fas fa-eye"></i> View Page</a>
                <?php if($this->session->userdata('user_id')==$data['user_id']): ?>
                    <a href="<?php echo base_url();?>TeamController/invite_team/<?php echo $team_id;?>" class="tm-nav-item external-link" title="Invite Team">Invite Team</a>
                <?php endif; ?>
                <?php if($this->session->userdata('user_id')==$data['user_id']): ?>
                    <a href="<?php echo base_url();?>TournamentController/join_tournament/<?php echo $team_id;?>" class="tm-nav-item external-link">Join Tournament</a>
               <!--  <?php endif; ?>
                <?php if($this->session->userdata('user_id')==$data['user_id']): ?>
                    <a href="<?php echo base_url();?>TeamController/match_request/<?php echo $team_id;?>" class="tm-nav-item external-link" title="Team Request">Play Match</a>
                <?php endif; ?>
                <?php if($this->session->userdata('user_id')==$data['user_id']): ?>
                    <a href="<?php echo base_url();?>TeamController/player_request/<?php echo $team_id;?>" class="tm-nav-item external-link" title="Player Request">Player Request <span class="tm-badge">2</span></a>
                <?php endif; ?>
                <?php if($this->session->userdata('user_id')==$data['user_id']): ?>
                    <a href="<?php echo base_url();?>TeamController/team_request/<?php echo $team_id;?>" class="tm-nav-item external-link" title="Match Request">Team Request</a>
                <?php endif; ?> -->
            </div>
        </div>

        <!-- Player Requests -->
        <section class="tm-section" id="tm-player-req">
            <h3 class="tm-section-title">Player Requests (<?php echo count($requests); ?>)</h3>
            <?php if(count($requests) > 0): ?>
                <?php foreach ($requests as $player_info) { ?>
                <div class="tm-card">
                    <img src="<?php echo $player_info->image_path; ?>" alt="Player" class="tm-card-img">
                    <div class="tm-card-content">
                        <a href="<?php echo base_url();?>PlayerController/profile_player/<?php echo $player_info->player_id;?>" class="internal-link">
                            <h4><?php echo $player_info->playerName;?></h4>
                        </a>
                        <p><?php echo $player_info->player_role;?></p>
                    </div>
                    <div class="tm-btn-group">
                        <a href="<?php echo base_url();?>TeamController/accept_request/<?php echo $player_info->player_id;?>/<?php echo $player_info->team_id;?>">
                            <button class="tm-btn tm-btn-success tm-btn-sm">Accept</button>
                        </a>
                        <a href="<?php echo base_url();?>TeamController/cancel_player_request/<?php echo $player_info->player_id;?>/<?php echo $player_info->team_id;?>">
                            <button class="tm-btn tm-btn-danger tm-btn-sm">Reject</button>
                        </a>
                    </div>
                </div>
                <?php } ?>
            <?php else: ?>
                <p class="tm-empty-state">No player requests</p>
            <?php endif; ?>
        </section>

        <!-- Team Requests -->
        <section class="tm-section" id="tm-team-req">
            <h3 class="tm-section-title">Team Requests (<?php echo count($team_names['received_request'] ?? []); ?>)</h3>
            <?php if (isset($team_names['received_request']) && !empty($team_names['received_request'])): ?>
                <?php foreach ($team_names['received_request'] as $value) { ?>
                <div class="tm-card">
                    <img src="<?php echo $value->image_path; ?>" alt="Team" class="tm-card-img">
                    <div class="tm-card-content">
                        <h4><?php echo $value->team_name; ?></h4>
                        <p><?php echo $value->city; ?></p>
                    </div>
                    <div class="tm-btn-group">
                        <a href="<?php echo base_url();?>TeamController/accept_match_request/<?php echo $team_id;?>/<?php echo $value->team_id;?>">
                            <button class="tm-btn tm-btn-success tm-btn-sm">Accept</button>
                        </a>
                        <a href="<?php echo base_url();?>TeamController/reject_match_request/<?php echo $team_id;?>/<?php echo $value->team_id;?>">
                            <button class="tm-btn tm-btn-danger tm-btn-sm">Reject</button>
                        </a>
                    </div>
                </div>
                <?php } ?>
            <?php else: ?>
                <p class="tm-empty-state">No team requests</p>
            <?php endif; ?>
        </section>
       
        <!-- Opposition Team Section -->
        <section class="tm-section" id="tm-schedule">
            <h3 class="tm-section-title">Opposition Team</h3>
            <?php if ($opposition_team['status'] == 'error'): ?>
                <div class="tm-empty-state">
                    <?php echo $opposition_team['message']; ?>
                </div>
            <?php else: ?>
                <?php foreach ($opposition_team['data'] as $team): ?>
                    <div class="tm-card">
                        <img src="<?php echo $team->team_one_image;?>" alt="Team Logo" class="tm-card-img">
                        <div class="tm-card-content">
                            <h4><a href="<?php echo base_url();?>TeamController/team_profile/<?php echo $team->team_one_id;?>"><?php echo $team->team_one_name;?></a></h4>
                            <p>Opponent Team</p>
                        </div>
                        <a href="<?php echo base_url();?>Welcome/enter_schedule/<?php echo $team->team_two_id;?>/<?php echo $team->team_one_id;?>" class="tm-btn tm-btn-primary tm-btn-sm">Add Schedule</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

        <!-- Schedule Section -->
        <section class="tm-section">
            <h3 class="tm-section-title">Match Schedule</h3>
            <?php if($team_schedule == 0): ?>
                <p class="tm-empty-state">No match is added yet</p>
            <?php else: ?>
                <div class="tm-schedule-line-container">
                    <?php foreach ($team_schedule as $value): ?>
                        <?php $isAdmin = ($this->session->userdata('user_id') == $value->user_id); ?>
                        <div class="tm-schedule-line <?php echo $isAdmin ? 'admin-match' : ''; ?>">
                            <div class="tm-schedule-teams">
                                <div class="tm-schedule-team <?php echo $value->team_one_id == $team_id ? 'your-team' : ''; ?>">
                                    <img src="<?php echo $value->team_one_image;?>" alt="Team Logo">
                                    <span><?php echo strtoupper(substr($value->team_one_name, 0, 3));?></span>
                                    <?php if($value->team_one_id == $team_id): ?>
                                        <span class="tm-team-you">(You)</span>
                                    <?php endif; ?>
                                </div>
                                <span class="tm-schedule-vs">vs</span>
                                <div class="tm-schedule-team <?php echo $value->team_two_id == $team_id ? 'your-team' : ''; ?>">
                                    <img src="<?php echo $value->team_two_image;?>" alt="Team Logo">
                                    <span><?php echo strtoupper(substr($value->team_two_name, 0, 3));?></span>
                                    <?php if($value->team_two_id == $team_id): ?>
                                        <span class="tm-team-you">(You)</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="tm-schedule-actions">
                                <?php if($isAdmin): ?>
                                    <div class="tm-admin-actions">
                                        <a href="<?php echo base_url();?>Welcome/toss/<?php echo $value->team_one_id;?>/<?php echo $value->team_two_id;?>/<?php echo $value->match_id;?>" class="tm-btn tm-btn-primary tm-btn-xs">Score</a>
                                        <a href="<?php echo base_url();?>Welcome/edit_schedule/<?php echo $value->team_one_id;?>/<?php echo $value->team_two_id;?>/<?php echo $value->match_id;?>" class="tm-btn tm-btn-warning tm-btn-xs">Edit</a>
                                    </div>
                                <?php endif; ?>
                                <a href="<?php echo base_url();?>Welcome/scorecard/<?php echo $value->team_one_id;?>/<?php echo $value->team_two_id;?>/<?php echo $value->match_id;?>" class="tm-btn tm-btn-outline tm-btn-xs">View</a>
                            </div>
                            <div class="tm-schedule-meta">
                                <?php $date=$value->match_date; $formatted_date = date("M d", strtotime($date)); ?>
                                <span class="tm-schedule-date"><?php echo $formatted_date;?></span>
                                <span class="tm-schedule-time"><?php echo date("g:i A", strtotime($value->match_time));?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <!-- Team Information -->
        <section class="tm-section" id="tm-team-info">
            <h3 class="tm-section-title">Team Information</h3>
            <div class="tm-info-item">
                <div><strong>City:</strong> <span id="tm-city"><?php echo $data['city']; ?></span></div>
                <button class="tm-btn tm-btn-warning tm-btn-sm" onclick="tmEditField('city', 'City', 'text')">Edit</button>
            </div>
            <div class="tm-info-item">
                <div><strong>Country:</strong> <span id="tm-country"><?php echo $data['country']; ?></span></div>
                <button class="tm-btn tm-btn-warning tm-btn-sm" onclick="tmEditField('country', 'Country', 'text')">Edit</button>
            </div>
            <div class="tm-info-item">
                <div><strong>Home Ground:</strong> <span id="tm-ground"><?php echo $data['home_ground']; ?></span></div>
                <button class="tm-btn tm-btn-warning tm-btn-sm" onclick="tmEditField('ground', 'Home Ground', 'text')">Edit</button>
            </div>
            <div class="tm-info-item">
                <div><strong>Admin Phone:</strong> <span id="tm-phone"><?php echo $data['phone_number']; ?></span></div>
                <button class="tm-btn tm-btn-warning tm-btn-sm" onclick="tmEditField('phone', 'Admin Phone', 'tel')">Edit</button>
            </div>
        </section>

        <!-- Captains -->
        <section class="tm-section" id="tm-captains">
            <h3 class="tm-section-title">Current Captains</h3>
            <div class="tm-captain-grid">
                <div class="tm-captain-card">
                    <h4>Leather Ball</h4>
                    <?php if ($captain['leather_ball']['status'] === 0) { 
                        if($this->session->userdata('user_id') == $data['user_id']) { ?>
                        <a href="<?php echo base_url();?>TeamController/add_captain_leather/<?php echo $team_id;?>" class="internal-link">
                            <button class="tm-btn tm-btn-primary tm-btn-sm">Add</button>
                        </a>
                    <?php } else { echo "<p class='tm-empty-state'>Not assigned</p>"; }   
                    } else { ?>
                    <img src="<?php echo $captain['leather_ball']['image_path'];?>" alt="Captain" class="tm-captain-img">
                    <p><?php echo $captain['leather_ball']['playerName'];?></p>
                    <?php if($this->session->userdata('user_id') == $data['user_id']): ?>
                        <button class="tm-btn tm-btn-warning tm-btn-sm">Edit</button>
                    <?php endif; }?>
                </div>
                <div class="tm-captain-card">
                    <h4>Tape Ball</h4>
                    <?php if ($captain['tape_ball']['status'] === 0) { 
                        if($this->session->userdata('user_id') == $data['user_id']) { ?>
                        <a href="<?php echo base_url();?>TeamController/add_captain_tape/<?php echo $team_id;?>" class="internal-link">
                            <button class="tm-btn tm-btn-primary tm-btn-sm">Add</button>
                        </a>
                    <?php } else { echo "<p class='tm-empty-state'>Not assigned</p>"; }   
                    } else { ?>
                    <img src="<?php echo $captain['tape_ball']['image_path'];?>" alt="Captain" class="tm-captain-img">
                    <p><?php echo $captain['tape_ball']['playerName'];?></p>
                    <?php if($this->session->userdata('user_id') == $data['user_id']): ?>
                        <button class="tm-btn tm-btn-warning tm-btn-sm">Edit</button>
                    <?php endif; }?>
                </div>
                <div class="tm-captain-card">
                    <h4>Tennis Ball</h4>
                    <?php if ($captain['tennis_ball']['status'] === 0) { 
                        if($this->session->userdata('user_id') == $data['user_id']) { ?>
                        <a href="<?php echo base_url();?>TeamController/add_captain_tennis/<?php echo $team_id;?>" class="internal-link">
                            <button class="tm-btn tm-btn-primary tm-btn-sm">Add</button>
                        </a>
                    <?php } else { echo "<p class='tm-empty-state'>Not assigned</p>"; }   
                    } else { ?>
                    <img src="<?php echo $captain['tennis_ball']['image_path'];?>" alt="Captain" class="tm-captain-img">
                    <p><?php echo $captain['tennis_ball']['playerName'];?></p>
                    <?php if($this->session->userdata('user_id') == $data['user_id']): ?>
                        <button class="tm-btn tm-btn-warning tm-btn-sm">Edit</button>
                    <?php endif; }?>
                </div>
            </div>
        </section>

        <!-- Management -->
        <section class="tm-section" id="tm-management">
            <h3 class="tm-section-title">Team Management</h3>
            <div class="insert-section">
                <button class="tm-btn tm-btn-primary" onclick="openManagementModal('insert', '', '')">Insert New Member</button>
            </div>
            <div class="team-container">
                <?php 
                // Define management staff with their default values
                $management_staff = [
                    'coach' => ['name' => 'Michael Smith', 'designation' => 'Head Coach'],
                    'manager' => ['name' => 'Sarah Johnson', 'designation' => 'Team Manager'],
                    'physio' => ['name' => 'David Brown', 'designation' => 'Physiotherapist'],
                    'analyst' => ['name' => 'Emily Davis', 'designation' => 'Data Analyst'],
                    'asst' => ['name' => 'James Wilson', 'designation' => 'Assistant Coach']
                ];
                
                // Check if there's saved management data in session or database
                if(isset($_SESSION['team_management_data'])) {
                    foreach($_SESSION['team_management_data'] as $role => $data) {
                        if(isset($management_staff[$role])) {
                            $management_staff[$role] = $data;
                        }
                    }
                }
                ?>
                <?php foreach($management_staff as $role => $staff): ?>
                <div class="team-row" id="staff-<?php echo $role; ?>">
                    <div class="team-info">
                        <h3><?php echo $staff['name']; ?></h3>
                        <p><?php echo $staff['designation']; ?></p>
                    </div>
                    <button class="tm-btn tm-btn-warning tm-btn-sm" onclick="openManagementModal('edit', '<?php echo $staff['name']; ?>', '<?php echo $staff['designation']; ?>', '<?php echo $role; ?>')">Edit</button>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <!-- Edit Field Modal (for Team Information) -->
    <div id="tm-edit-modal" class="tm-modal">
        <div class="tm-modal-content">
            <div class="tm-modal-header">
                <h3>Edit <span id="tm-edit-title"></span></h3>
                <span class="tm-modal-close" onclick="tmCloseModal()">×</span>
            </div>
            <div class="tm-form-group">
                <input type="text" id="tm-edit-input" class="tm-form-control">
            </div>
            <div class="tm-form-actions">
                <button class="tm-btn tm-btn-primary" onclick="tmSaveEdit()">Save</button>
                <button class="tm-btn tm-btn-danger" onclick="tmCloseModal()">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Team Management Modal -->
    <div id="tm-management-modal" class="tm-management-modal">
        <div class="tm-management-modal-content">
            <div class="tm-management-modal-header">
                <h3 id="tm-management-modal-title">Manage Staff Member</h3>
                <span class="tm-management-modal-close" onclick="closeManagementModal()">×</span>
            </div>
            <div class="tm-management-form-group">
                <label for="tm-management-name">Name</label>
                <input type="text" id="tm-management-name" placeholder="Enter name">
            </div>
            <div class="tm-management-form-group">
                <label for="tm-management-designation">Designation</label>
                <input type="text" id="tm-management-designation" placeholder="Enter designation">
            </div>
            <input type="hidden" id="tm-management-role">
            <div class="tm-management-form-actions">
                <button class="tm-btn tm-btn-primary" onclick="saveManagementChanges()">Save</button>
                <button class="tm-btn tm-btn-danger" onclick="closeManagementModal()">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        // Team Dashboard Functions (Team Information and Navigation)
        let tmCurrentField = null;

        // Field Editing (for Team Information)
        function tmEditField(field, title, type) {
            tmCurrentField = field;
            document.getElementById('tm-edit-title').textContent = title;
            document.getElementById('tm-edit-input').value = document.getElementById('tm-' + field).textContent;
            document.getElementById('tm-edit-input').type = type;
            
            if(type === 'date') {
                const dateValue = new Date(document.getElementById('tm-' + field).textContent).toISOString().split('T')[0];
                document.getElementById('tm-edit-input').value = dateValue;
            }
            
            document.getElementById('tm-edit-modal').style.display = 'block';
            document.getElementById('tm-edit-input').focus();
        }

        function tmSaveEdit() {
            const newValue = document.getElementById('tm-edit-input').value;
            document.getElementById('tm-' + tmCurrentField).textContent = newValue;
            
            // Show loading state
            const saveBtn = document.querySelector('#tm-edit-modal .tm-btn-primary');
            const originalText = saveBtn.textContent;
            saveBtn.innerHTML = '<span class="tm-loading-text">Saving...</span>';
            saveBtn.disabled = true;
            
            // AJAX call to save changes
            fetch('/update-team-info', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    field: tmCurrentField,
                    value: newValue,
                    team_id: <?php echo $team_id; ?>
                })
            })
            .then(response => response.json())
            .then(data => {
                if(!data.success) {
                    alert('Error saving changes');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saving changes');
            })
            .finally(() => {
                saveBtn.textContent = originalText;
                saveBtn.disabled = false;
                tmCloseModal();
            });
        }

        function tmCloseModal() {
            document.getElementById('tm-edit-modal').style.display = 'none';
            tmCurrentField = null;
        }

        // Team Management Modal Functions
        function openManagementModal(action, name = '', designation = '', role = '') {
            const modal = document.getElementById('tm-management-modal');
            const title = document.getElementById('tm-management-modal-title');
            const nameInput = document.getElementById('tm-management-name');
            const designationInput = document.getElementById('tm-management-designation');
            const roleInput = document.getElementById('tm-management-role');

            if (action === 'insert') {
                title.textContent = 'Add New Member';
                nameInput.value = '';
                designationInput.value = '';
                roleInput.value = '';
            } else {
                title.textContent = 'Edit Member';
                nameInput.value = name;
                designationInput.value = designation;
                roleInput.value = role;
            }

            modal.style.display = 'block';
            nameInput.focus();
        }

        function closeManagementModal() {
            document.getElementById('tm-management-modal').style.display = 'none';
        }

        function saveManagementChanges() {
            const name = document.getElementById('tm-management-name').value;
            const designation = document.getElementById('tm-management-designation').value;
            const role = document.getElementById('tm-management-role').value;

            if (!name || !designation) {
                alert('Please fill in both name and designation.');
                return;
            }

            // Static alert for demo purposes; user to implement backend saving
            alert(`Saving: Name: ${name}, Designation: ${designation}${role ? ', Role: ' + role : ''}`);

            // Close modal
            closeManagementModal();
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('tm-modal')) {
                tmCloseModal();
            }
            if (event.target.classList.contains('tm-management-modal')) {
                closeManagementModal();
            }
        };

        // Close modals with ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                tmCloseModal();
                closeManagementModal();
            }
        });

        // Smooth scrolling for navigation
        document.querySelectorAll('.tm-nav-item').forEach(link => {
            link.addEventListener('click', function(e) {
                if(this.getAttribute('href').startsWith('#')) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if(target) {
                        window.scrollTo({
                            top: target.offsetTop - 70,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Highlight active section based on scroll position
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('.tm-section');
            const navItems = document.querySelectorAll('.tm-nav-item');
            let currentSection = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                if(window.scrollY >= sectionTop) {
                    currentSection = '#' + section.getAttribute('id');
                }
            });
            
            navItems.forEach(item => {
                item.classList.remove('active');
                if(item.getAttribute('href') === currentSection) {
                    item.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>