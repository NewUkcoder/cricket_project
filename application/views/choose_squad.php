<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Match Squads</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            color: #333;
            line-height: 1.5;
            padding: 15px;
            min-height: 100vh;
        }

        .squad-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .match-header {
            padding: 15px;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            text-align: center;
        }

        .teams-display {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .team {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .team-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
            border-radius: 50%;
            background: white;
            padding: 3px;
            margin-bottom: 5px;
        }

        .team-name {
            font-size: 16px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

        .vs-text {
            font-size: 14px;
            font-weight: 700;
            color: #ffcc00;
            flex-shrink: 0;
        }

        .match-info {
            font-size: 12px;
            opacity: 0.9;
            margin-top: 5px;
        }

        .squad-section {
            padding: 15px;
        }

        .squad-title {
            font-size: 16px;
            font-weight: 600;
            color: #2a5298;
            margin-bottom: 15px;
            text-align: center;
        }

        .team-squad {
            margin-bottom: 20px;
        }

        .team-squad-title {
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .team-squad-title img {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            object-fit: contain;
        }

        .player-list {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #eee;
        }

        .player-item {
            display: flex;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .player-item:last-child {
            border-bottom: none;
        }

        .player-checkbox {
            margin-right: 10px;
        }

        .player-name {
            font-size: 14px;
            flex: 1;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: #2a5298;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 15px;
        }

        .submit-btn:hover {
            background: #1e3c72;
        }

        .error-message {
            color: #dc3545;
            font-size: 12px;
            text-align: center;
            margin-top: 5px;
            display: none;
        }

        @media (max-width: 480px) {
            .squad-container {
                max-width: 100%;
            }

            .team-logo {
                width: 36px;
                height: 36px;
            }

            .team-name {
                font-size: 14px;
            }

            .vs-text {
                font-size: 13px;
            }

            .squad-title {
                font-size: 14px;
            }

            .team-squad-title {
                font-size: 13px;
            }

            .player-name {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="squad-container">
        <div class="match-header">
            <div class="teams-display">
                <div class="team">
                    <img src="https://via.placeholder.com/40" alt="Team 1 Logo" class="team-logo">
                    <div class="team-name">Mumbai Indians</div>
                </div>
                <div class="vs-text">vs</div>
                <div class="team">
                    <img src="https://via.placeholder.com/40" alt="Team 2 Logo" class="team-logo">
                    <div class="team-name">Chennai Super Kings</div>
                </div>
            </div>
            <div class="match-info">
                Match ID: 12345 | Date: 08 Apr 2025
            </div>
        </div>

        <div class="squad-section">
            <div class="squad-title">Choose Squads for the Match</div>

            <form action="#" method="POST" id="squadForm">
                <!-- Team 1 Squad: Mumbai Indians -->
                <div class="team-squad">
                    <div class="team-squad-title">
                        <img src="https://via.placeholder.com/24" alt="Team 1 Logo">
                        Mumbai Indians Squad
                    </div>
                    <div class="player-list">
                        <div class="player-item">
                            <input type="checkbox" name="team1_players[]" value="1" class="player-checkbox team1-player">
                            <div class="player-name">Rohit Sharma</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team1_players[]" value="2" class="player-checkbox team1-player">
                            <div class="player-name">Ishan Kishan</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team1_players[]" value="3" class="player-checkbox team1-player">
                            <div class="player-name">Suryakumar Yadav</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team1_players[]" value="4" class="player-checkbox team1-player">
                            <div class="player-name">Hardik Pandya</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team1_players[]" value="5" class="player-checkbox team1-player">
                            <div class="player-name">Jasprit Bumrah</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team1_players[]" value="6" class="player-checkbox team1-player">
                            <div class="player-name">Kieron Pollard</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team1_players[]" value="7" class="player-checkbox team1-player">
                            <div class="player-name">Tilak Varma</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team1_players[]" value="8" class="player-checkbox team1-player">
                            <div class="player-name">Trent Boult</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team1_players[]" value="9" class="player-checkbox team1-player">
                            <div class="player-name">Quinton de Kock</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team1_players[]" value="10" class="player-checkbox team1-player">
                            <div class="player-name">Piyush Chawla</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team1_players[]" value="11" class="player-checkbox team1-player">
                            <div class="player-name">Rahul Chahar</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team1_players[]" value="12" class="player-checkbox team1-player">
                            <div class="player-name">Dewald Brevis</div>
                        </div>
                    </div>
                    <div class="error-message" id="team1-error">Maximum 11 players can be selected.</div>
                </div>

                <!-- Team 2 Squad: Chennai Super Kings -->
                <div class="team-squad">
                    <div class="team-squad-title">
                        <img src="https://via.placeholder.com/24" alt="Team 2 Logo">
                        Chennai Super Kings Squad
                    </div>
                    <div class="player-list">
                        <div class="player-item">
                            <input type="checkbox" name="team2_players[]" value="13" class="player-checkbox team2-player">
                            <div class="player-name">Ruturaj Gaikwad</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team2_players[]" value="14" class="player-checkbox team2-player">
                            <div class="player-name">Devon Conway</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team2_players[]" value="15" class="player-checkbox team2-player">
                            <div class="player-name">MS Dhoni</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team2_players[]" value="16" class="player-checkbox team2-player">
                            <div class="player-name">Ravindra Jadeja</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team2_players[]" value="17" class="player-checkbox team2-player">
                            <div class="player-name">Deepak Chahar</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team2_players[]" value="18" class="player-checkbox team2-player">
                            <div class="player-name">Moeen Ali</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team2_players[]" value="19" class="player-checkbox team2-player">
                            <div class="player-name">Shivam Dube</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team2_players[]" value="20" class="player-checkbox team2-player">
                            <div class="player-name">Tushar Deshpande</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team2_players[]" value="21" class="player-checkbox team2-player">
                            <div class="player-name">Matheesha Pathirana</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team2_players[]" value="22" class="player-checkbox team2-player">
                            <div class="player-name">Ajinkya Rahane</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team2_players[]" value="23" class="player-checkbox team2-player">
                            <div class="player-name">Mitchell Santner</div>
                        </div>
                        <div class="player-item">
                            <input type="checkbox" name="team2_players[]" value="24" class="player-checkbox team2-player">
                            <div class="player-name">Ben Stokes</div>
                        </div>
                    </div>
                    <div class="error-message" id="team2-error">Maximum 11 players can be selected.</div>
                </div>

                <input type="hidden" name="match_id" value="12345">
                <button type="submit" class="submit-btn">Save Squads</button>
            </form>
        </div>
         <a href="<?php echo base_url();?>Welcome/scorecard_links/<?php echo htmlspecialchars($bowl_first ?? ''); ?>/<?php echo htmlspecialchars($batting_first ?? ''); ?>/<?php echo htmlspecialchars($match_id ?? ''); ?>">
                    <button class="btn btn-success next-btn">
                        <i class="bi bi-arrow-right-circle-fill"></i> Next Inning
                    </button>
                </a>
    </div>

    <script>
        const maxPlayers = 11;

        // Function to limit checkbox selections
        function limitCheckboxes(teamClass, errorId) {
            const checkboxes = document.querySelectorAll(`.${teamClass}`);
            const errorMessage = document.getElementById(errorId);

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const checkedCount = document.querySelectorAll(`.${teamClass}:checked`).length;
                    if (checkedCount > maxPlayers) {
                        this.checked = false;
                        errorMessage.style.display = 'block';
                        setTimeout(() => {
                            errorMessage.style.display = 'none';
                        }, 2000); // Hide error after 2 seconds
                    } else {
                        errorMessage.style.display = 'none';
                    }
                });
            });
        }

        // Apply limit to Team 1 (Mumbai Indians)
        limitCheckboxes('team1-player', 'team1-error');

        // Apply limit to Team 2 (Chennai Super Kings)
        limitCheckboxes('team2-player', 'team2-error');

        // Form submission validation
        document.getElementById('squadForm').addEventListener('submit', function(e) {
            const team1Checked = document.querySelectorAll('.team1-player:checked').length;
            const team2Checked = document.querySelectorAll('.team2-player:checked').length;

            if (team1Checked > maxPlayers || team2Checked > maxPlayers) {
                e.preventDefault();
                alert('Each team can select a maximum of 11 players.');
            }
        });
    </script>
</body>
</html>