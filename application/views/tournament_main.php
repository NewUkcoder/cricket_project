<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cricket League Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
       background-color: white;
            color: #333;
            font-size: 14px;
    }
    .navbar {
      background-color: #005f8d;
      color: white;
      padding: 10px 20px;
      display: flex;
      overflow-x: auto;
      white-space: nowrap;
      scroll-behavior: smooth;
      -webkit-overflow-scrolling: touch;
      position: sticky; /* Make the navbar sticky */
      top: 0; /* Stick it to the top */
      z-index: 1000; /* Ensure it stays above other content */
    }

    /* Hide scrollbar for WebKit browsers */
    .navbar::-webkit-scrollbar {
      display: none;
    }

    .navbar a {
  color: white;
            text-decoration: none;
            font-size: 1em;
            padding: 6px 12px;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .navbar a:hover {
      color: #ffd700;
    }

    .container {
      margin-top: 20px;
    }
    .card {
      margin-bottom: 20px;
      border: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card-header {
      background-color: #005f8d;
      color: white;
      font-weight: bold;
      padding: 15px;
    }
    .btn-primary {
      background-color: #1e3a8a;
      border: none;
      transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #152c5b;
    }
    .btn-danger {
      background-color: #dc3545;
      border: none;
      transition: background-color 0.3s ease;
    }
    .btn-danger:hover {
      background-color: #a71d2a;
    }
    .schedule-table {
      width: 100%;
      border-collapse: collapse;
    }
    .schedule-table th, .schedule-table td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: center;
    }
    .schedule-table th {
      background-color: #1e3a8a;
      color: white;
    }
    .team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }
    .team-card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      text-align: center;
      transition: transform 0.3s ease;
    }
    .team-card:hover {
      transform: translateY(-5px);
    }
    .team-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
    }
    .team-card h4 {
      margin: 10px 0;
      font-size: 1.2rem;
      color: #1e3a8a;
    }
    .team-card p {
      margin: 5px 0;
      color: #555;
    }
    .league-info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }
    .league-info-card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
      transition: transform 0.3s ease;
    }
    .league-info-card:hover {
      transform: translateY(-5px);
    }
    .league-info-card h4 {
      margin: 10px 0;
      font-size: 1.2rem;
      color: #1e3a8a;
    }
    .league-info-card p {
      margin: 5px 0;
      color: #555;
    }
    .match-card {
      background: white;
      padding: 20px;
      margin-bottom: 15px;
      border-radius: 8px;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }
    .match-card:hover {
      transform: translateY(-5px);
    }
    .team {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .team img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
    }
    .match-details {
      text-align: center;
      margin-top: 10px;
    }
    .schedule-links {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 10px;
    }
    .schedule-links a {
      text-decoration: none;
      color: #1e3a8a;
      font-weight: bold;
      transition: color 0.3s ease;
    }
    .schedule-links a:hover {
      color: #ffd700;
      text-decoration: underline;
    }

    /* External Header Section */
    .external-header {
      background: white;
      color: #005f8d;
      text-align: center;
      padding: 20px 0;
      border-bottom: 2px solid #005f8d;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .external-header h1 {
      font-size: 2.5em;
      letter-spacing: 1px;
      text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
      margin-bottom: 10px;
    }
    .external-header .league-info {
      font-size: 1.1em;
      color: #666;
      margin-top: 10px;
    }

    /* Add Rules Section */
    .rules-list {
      margin-top: 20px;
    }

    .rule-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }

    .rule-item:last-child {
      border-bottom: none;
    }

    .rule-item .edit-link {
      color: #1e3a8a;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    .rule-item .edit-link:hover {
      color: #ffd700;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <!-- External Header Section -->
  <div class="external-header">
    <h1>Cricket League Admin</h1>
    <div class="league-info">
      <p>Year: 2025 | City: Mumbai | Country: India</p>
    </div>
  </div>

  <!-- Horizontal Navigation Bar -->
  <div class="navbar">
    <a href="#league-info">League Info</a>
    <a href="#team-requests">Team Requests</a>
    <a href="#add-schedule">Add Schedule</a>
    <a href="#schedule-scorecard">Schedule & Scorecard</a>
    <a href="#add-rules">Add Rules</a>
  </div>

  <!-- Main Content -->
  <div class="container">
    <!-- Team Requests Section -->
    <div id="team-requests" class="card">
      <div class="card-header">Team Requests</div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>Team Name</th>
              <th>Captain</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Team A</td>
              <td>John Doe</td>
              <td>
                <button class="btn btn-primary">Accept</button>
                <button class="btn btn-danger">Reject</button>
              </td>
            </tr>
            <tr>
              <td>Team B</td>
              <td>Jane Smith</td>
              <td>
                <button class="btn btn-primary">Accept</button>
                <button class="btn btn-danger">Reject</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- League Information Section -->
    <div id="league-info" class="card">
      <div class="card-header">League Information</div>
      <div class="card-body">
        <div class="league-info-grid">
          <div class="league-info-card">
            <h4>Country</h4>
            <p>India</p>
          </div>
          <div class="league-info-card">
            <h4>City</h4>
            <p>Mumbai</p>
          </div>
          <div class="league-info-card">
            <h4>League Name</h4>
            <p>Mumbai Premier League</p>
          </div>
          <div class="league-info-card">
            <h4>Season</h4>
            <p>2023</p>
          </div>
          <div class="league-info-card">
            <h4>Total Teams</h4>
            <p>6</p>
          </div>
          <div class="league-info-card">
            <h4>Format</h4>
            <p>T20</p>
          </div>
          <div class="league-info-card">
            <h4>Organizer</h4>
            <p>Mumbai Cricket Association</p>
          </div>
          <div class="league-info-card">
            <h4>Description</h4>
            <p>The Mumbai Premier League is a professional T20 cricket league featuring the best local talent in Mumbai. The league aims to promote cricket at the grassroots level and provide a platform for young players to showcase their skills.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Teams Section -->
    <div class="card">
      <div class="card-header">Teams</div>
      <div class="card-body">
        <div class="team-grid">
          <!-- Team 1 -->
          <div class="team-card">
            <img src="https://via.placeholder.com/200x150?text=Team+A" alt="Team A">
            <h4>Team A</h4>
            <p>Captain: John Doe</p>
            <p>Matches Played: 5</p>
            <p>Points: 10</p>
          </div>
          <!-- Team 2 -->
          <div class="team-card">
            <img src="https://via.placeholder.com/200x150?text=Team+B" alt="Team B">
            <h4>Team B</h4>
            <p>Captain: Jane Smith</p>
            <p>Matches Played: 5</p>
            <p>Points: 8</p>
          </div>
          <!-- Team 3 -->
          <div class="team-card">
            <img src="https://via.placeholder.com/200x150?text=Team+C" alt="Team C">
            <h4>Team C</h4>
            <p>Captain: Rajesh Kumar</p>
            <p>Matches Played: 5</p>
            <p>Points: 7</p>
          </div>
          <!-- Team 4 -->
          <div class="team-card">
            <img src="https://via.placeholder.com/200x150?text=Team+D" alt="Team D">
            <h4>Team D</h4>
            <p>Captain: Priya Singh</p>
            <p>Matches Played: 5</p>
            <p>Points: 6</p>
          </div>
          <!-- Team 5 -->
          <div class="team-card">
            <img src="https://via.placeholder.com/200x150?text=Team+E" alt="Team E">
            <h4>Team E</h4>
            <p>Captain: Ravi Shastri</p>
            <p>Matches Played: 5</p>
            <p>Points: 5</p>
          </div>
          <!-- Team 6 -->
          <div class="team-card">
            <img src="https://via.placeholder.com/200x150?text=Team+F" alt="Team F">
            <h4>Team F</h4>
            <p>Captain: Anjali Mehta</p>
            <p>Matches Played: 5</p>
            <p>Points: 4</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Add Schedule Section -->
    <div id="add-schedule" class="card">
      <div class="card-header">Add Schedule</div>
      <div class="card-body">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addScheduleModal">Add Schedule</button>
      </div>
    </div>

    <!-- Schedule & Scorecard Section -->
    <div id="schedule-scorecard" class="card">
      <div class="card-header">Schedule & Scorecard</div>
      <div class="card-body">
        <div class="match-card">
          <div class="team">
            <img src="team-a.png" alt="Team A">
            <span>Team A</span>
            <strong>vs</strong>
            <span>Team B</span>
            <img src="team-b.png" alt="Team B">
          </div>
          <div class="match-details">
            <p><strong>Date:</strong> March 20, 2025</p>
            <p><strong>Time:</strong> 4:00 PM</p>
            <p><strong>Venue:</strong> National Stadium</p>
          </div>
          <div class="schedule-links">
            <a href="#">Edit</a> |
            <a href="#">Scorecard</a> |
            <a href="#">Delete</a>
          </div>
        </div>
        <div class="match-card">
          <div class="team">
            <img src="team-c.png" alt="Team C">
            <span>Team C</span>
            <strong>vs</strong>
            <span>Team D</span>
            <img src="team-d.png" alt="Team D">
          </div>
          <div class="match-details">
            <p><strong>Date:</strong> March 21, 2025</p>
            <p><strong>Time:</strong> 6:30 PM</p>
            <p><strong>Venue:</strong> City Ground</p>
          </div>
          <div class="schedule-links">
            <a href="#">Edit</a> |
            <a href="#">Scorecard</a> |
            <a href="#">Delete</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Add Rules Section -->
    <div id="add-rules" class="card">
      <div class="card-header">Add Rules</div>
      <div class="card-body">
        <form id="addRuleForm">
          <div class="mb-3">
            <label for="ruleDescription" class="form-label">Rule Description</label>
            <textarea class="form-control" id="ruleDescription" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Add Rule</button>
        </form>

        <!-- Rules List -->
        <div class="rules-list">
          <div class="rule-item">
            <span>1. All matches will be played in T20 format.</span>
            <a href="#" class="edit-link">Edit</a>
          </div>
          <div class="rule-item">
            <span>2. Each team can have a maximum of 15 players.</span>
            <a href="#" class="edit-link">Edit</a>
          </div>
          <div class="rule-item">
            <span>3. The tournament will follow ICC rules.</span>
            <a href="#" class="edit-link">Edit</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Schedule Modal -->
  <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addScheduleModalLabel">Add Schedule</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="scheduleForm">
            <div class="mb-3">
              <label for="matchDate" class="form-label">Match Date</label>
              <input type="date" class="form-control" id="matchDate" required>
            </div>
            <div class="mb-3">
              <label for="team1" class="form-label">Team 1</label>
              <input type="text" class="form-control" id="team1" required>
            </div>
            <div class="mb-3">
              <label for="team2" class="form-label">Team 2</label>
              <input type="text" class="form-control" id="team2" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Schedule</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Scorecard Modal -->
  <div class="modal fade" id="addScorecardModal" tabindex="-1" aria-labelledby="addScorecardModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addScorecardModalLabel">Add Scorecard</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="scorecardForm">
            <div class="mb-3">
              <label for="team1Score" class="form-label">Team 1 Score</label>
              <input type="text" class="form-control" id="team1Score" required>
            </div>
            <div class="mb-3">
              <label for="team2Score" class="form-label">Team 2 Score</label>
              <input type="text" class="form-control" id="team2Score" required>
            </div>
            <div class="mb-3">
              <label for="winner" class="form-label">Winner</label>
              <input type="text" class="form-control" id="winner" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Scorecard</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // JavaScript to handle adding rules
    document.getElementById('addRuleForm').addEventListener('submit', function (e) {
      e.preventDefault();

      // Get the rule description
      const ruleDescription = document.getElementById('ruleDescription').value;

      // Create a new rule item
      const rulesList = document.querySelector('.rules-list');
      const newRuleItem = document.createElement('div');
      newRuleItem.className = 'rule-item';
      newRuleItem.innerHTML = `
        <span>${rulesList.children.length + 1}. ${ruleDescription}</span>
        <a href="#" class="edit-link">Edit</a>
      `;

      // Append the new rule to the list
      rulesList.appendChild(newRuleItem);

      // Reset the form
      document.getElementById('addRuleForm').reset();
    });

    // Placeholder for edit functionality
    document.querySelectorAll('.edit-link').forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        alert('Edit functionality will be implemented here.');
      });
    });

    // JavaScript to handle adding schedules
    document.getElementById('scheduleForm').addEventListener('submit', function (e) {
      e.preventDefault();

      // Get form values
      const matchDate = document.getElementById('matchDate').value;
      const team1 = document.getElementById('team1').value;
      const team2 = document.getElementById('team2').value;

      // Add schedule to the table
      const scheduleTableBody = document.getElementById('scheduleTableBody');
      const newRow = document.createElement('tr');
      newRow.innerHTML = `
        <td>${matchDate}</td>
        <td>${team1}</td>
        <td>${team2}</td>
        <td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addScorecardModal">Add Scorecard</button></td>
        <td><button class="btn btn-danger">Delete</button></td>
      `;
      scheduleTableBody.appendChild(newRow);

      // Close the modal
      const modal = bootstrap.Modal.getInstance(document.getElementById('addScheduleModal'));
      modal.hide();

      // Reset the form
      document.getElementById('scheduleForm').reset();
    });

    // JavaScript to handle adding scorecards
    document.getElementById('scorecardForm').addEventListener('submit', function (e) {
      e.preventDefault();

      // Get form values
      const team1Score = document.getElementById('team1Score').value;
      const team2Score = document.getElementById('team2Score').value;
      const winner = document.getElementById('winner').value;

      // Display scorecard (you can save this data to a database or display it dynamically)
      alert(`Scorecard Added:\nTeam 1: ${team1Score}\nTeam 2: ${team2Score}\nWinner: ${winner}`);

      // Close the modal
      const modal = bootstrap.Modal.getInstance(document.getElementById('addScorecardModal'));
      modal.hide();

      // Reset the form
      document.getElementById('scorecardForm').reset();
    });
  </script>
</body>
</html>