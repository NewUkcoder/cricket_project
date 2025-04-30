<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Cricket Score</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .score-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
        }
        .match-header {
            background-color: #28a745;
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .match-completed {
            background-color: #dc3545;
        }
        .score-board {
            text-align: center;
            padding: 20px 0;
        }
        .score-board h1 {
            font-size: 2.5rem;
            margin: 0;
            color: #333;
        }
        .score-board h3 {
            font-size: 1.5rem;
            color: #555;
        }
        .player-info {
            font-size: 1rem;
            color: #333;
            margin-top: 10px;
        }
        .player-selection {
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 15px;
            display: none;
            animation: fadeIn 0.5s;
        }
        .player-selection .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .player-selection .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        .player-selection .card-body {
            background-color: #fff;
        }
        .ball-input {
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .ball-input button {
            margin: 5px;
            min-width: 60px;
        }
        .undo-btn {
            margin-top: 10px;
        }
        .ball-by-ball {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 0 0 10px 10px;
            max-height: 300px;
            overflow-y: auto;
        }
        .ball-commentary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .ball-commentary:last-child {
            border-bottom: none;
        }
        .over-info {
            font-weight: bold;
            color: #28a745;
        }
        .disabled-section {
            opacity: 0.5;
            pointer-events: none;
        }
        .spinner-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 2000;
        }
        .commentary-icon {
            font-size: 1.2rem;
            margin-right: 5px;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @media (max-width: 576px) {
            .score-container {
                margin: 10px;
                padding: 10px;
            }
            .score-board h1 {
                font-size: 1.8rem;
            }
            .score-board h3 {
                font-size: 1.2rem;
            }
            .match-header h4 {
                font-size: 1.2rem;
            }
            .player-selection select, .ball-input button {
                font-size: 0.9rem;
            }
            .player-info {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="spinner-overlay" id="spinner">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="toast-container">
        <div class="toast" id="successToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="successToastBody"></div>
        </div>
        <div class="toast" id="errorToast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="errorToastBody"></div>
        </div>
    </div>
    <div class="container">
        <div class="score-container">
            <div class="match-header" id="match-header">
                <h4 id="match-title">Team A vs Team B - Live</h4>
                <p id="match-status">1st Innings | Overs: 0.0</p>
                <p id="target-score" style="display: none;">Target: 0</p>
            </div>
            <div class="score-board">
                <h1 id="current-score">0/0</h1>
                <h3 id="overs">Overs: 0.0</h3>
                <p id="run-rate">Run Rate: 0.00</p>
                <div class="player-info">
                    <p><strong>Striker:</strong> <span id="striker-name">None</span></p>
                    <p><strong>Non-Striker:</strong> <span id="non-striker-name">None</span></p>
                    <p><strong>Bowler:</strong> <span id="bowler-name">None</span> (<span id="bowler-overs">0.0</span> overs)</p>
                </div>
            </div>
            <div class="player-selection" id="player-selection">
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-header">Striker</div>
                            <div class="card-body">
                                <select class="form-select" id="striker" onchange="confirmPlayerChange('striker', this.value)" data-bs-toggle="tooltip" title="Select the batsman facing the ball">
                                    <option value="">Select Striker</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-header">Non-Striker</div>
                            <div class="card-body">
                                <select class="form-select" id="non-striker" onchange="confirmPlayerChange('non-striker', this.value)" data-bs-toggle="tooltip" title="Select the batsman at the other end">
                                    <option value="">Select Non-Striker</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 mb-2">
                        <div class="card">
                            <div class="card-header">Bowler</div>
                            <div class="card-body">
                                <select class="form-select" id="bowler" onchange="confirmPlayerChange('bowler', this.value)" data-bs-toggle="tooltip" title="Select the bowler for the over">
                                    <option value="">Select Bowler</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ball-input disabled-section" id="ball-input">
                <h5>Record Ball Outcome</h5>
                <div class="btn-group" role="group">
                    <button class="btn btn-primary" data-bs-toggle="tooltip" title="Dot ball" onclick="confirmBall('runs', 0)">0</button>
                    <button class="btn btn-primary" data-bs-toggle="tooltip" title="Single run" onclick="confirmBall('runs', 1)">1</button>
                    <button class="btn btn-primary" data-bs-toggle="tooltip" title="Two runs" onclick="confirmBall('runs', 2)">2</button>
                    <button class="btn btn-primary" data-bs-toggle="tooltip" title="Three runs" onclick="confirmBall('runs', 3)">3</button>
                    <button class="btn btn-primary" data-bs-toggle="tooltip" title="Boundary" onclick="confirmBall('runs', 4)">4</button>
                    <button class="btn btn-primary" data-bs-toggle="tooltip" title="Six" onclick="confirmBall('runs', 6)">6</button>
                </div>
                <div class="btn-group mt-2" role="group">
                    <button class="btn btn-danger" data-bs-toggle="tooltip" title="Record a wicket" onclick="$('#wicketModal').modal('show')">Wicket</button>
                    <button class="btn btn-warning" data-bs-toggle="tooltip" title="Wide ball" onclick="confirmBall('extra', 'wide')">Wide</button>
                    <button class="btn btn-warning" data-bs-toggle="tooltip" title="No-ball" onclick="confirmBall('extra', 'no-ball')">No-Ball</button>
                    <button class="btn btn-warning" data-bs-toggle="tooltip" title="Leg-bye runs" onclick="confirmBall('extra', 'leg-bye')">Leg-Bye</button>
                    <button class="btn btn-warning" data-bs-toggle="tooltip" title="Bye runs" onclick="confirmBall('extra', 'bye')">Bye</button>
                </div>
                <div class="undo-btn">
                    <button class="btn btn-secondary" data-bs-toggle="tooltip" title="Undo the last ball" onclick="showConfirmModal('undo', null, 'Confirm undo last ball?', undoLastBall)">Undo Last Ball</button>
                </div>
            </div>
            <div class="ball-by-ball" id="commentary"></div>
        </div>
    </div>

    <!-- Initial Player Selection Modal -->
    <div class="modal fade" id="playerSelectionModal" tabindex="-1" aria-labelledby="playerSelectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="playerSelectionModalLabel">Select Players</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="modal-striker" class="form-label">Striker:</label>
                        <select class="form-select" id="modal-striker">
                            <option value="">Select Striker</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="modal-non-striker" class="form-label">Non-Striker:</label>
                        <select class="form-select" id="modal-non-striker">
                            <option value="">Select Non-Striker</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="modal-bowler" class="form-label">Bowler:</label>
                        <select class="form-select" id="modal-bowler">
                            <option value="">Select Bowler</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="confirmPlayers()">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Batsman Selection Modal (for wickets) -->
    <div class="modal fade" id="batsmanSelectionModal" tabindex="-1" aria-labelledby="batsmanSelectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="batsmanSelectionModalLabel">Select New Batsman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="modal-new-batsman" class="form-label">New Batsman:</label>
                    <select class="form-select" id="modal-new-batsman">
                        <option value="">Select Batsman</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="confirmNewBatsman()">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bowler Selection Modal (for over change) -->
    <div class="modal fade" id="bowlerSelectionModal" tabindex="-1" aria-labelledby="bowlerSelectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bowlerSelectionModalLabel">Select New Bowler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="modal-new-bowler" class="form-label">New Bowler:</label>
                    <select class="form-select" id="modal-new-bowler">
                        <option value="">Select Bowler</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="confirmNewBowler()">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Wicket Confirmation Modal -->
    <div class="modal fade" id="wicketModal" tabindex="-1" aria-labelledby="wicketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wicketModalLabel">Wicket Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="dismissal-type" class="form-label">Dismissal Type:</label>
                    <select class="form-select" id="dismissal-type" onchange="toggleRunOutOptions()">
                        <option value="bowled">Bowled</option>
                        <option value="caught">Caught</option>
                        <option value="lbw">LBW</option>
                        <option value="run-out">Run Out</option>
                        <option value="stumped">Stumped</option>
                    </select>
                    <div id="run-out-options" style="display: none; margin-top: 10px;">
                        <label for="run-out-player" class="form-label">Batsman Out:</label>
                        <select class="form-select" id="run-out-player">
                            <option value="striker">Striker</option>
                            <option value="non-striker">Non-Striker</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="confirmWicket()">Confirm Wicket</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="confirmModalBody"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmModalButton">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let playersSelected = false;
            let currentModal = null;

            // Initialize tooltips
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

            // Show spinner
            function showSpinner() {
                $('#spinner').show();
            }

            // Hide spinner
            function hideSpinner() {
                $('#spinner').hide();
            }

            // Show toast
            function showToast(type, message) {
                const toastId = type === 'success' ? 'successToast' : 'errorToast';
                const toastBodyId = type === 'success' ? 'successToastBody' : 'errorToastBody';
                $(`#${toastBodyId}`).text(message);
                const toast = new bootstrap.Toast(document.getElementById(toastId));
                toast.show();
            }

            // Show custom confirmation modal
            function showConfirmModal(type, data, message, callback) {
                $('#confirmModalBody').text(message);
                $('#confirmModalButton').off('click').on('click', function() {
                    $('#confirmModal').modal('hide');
                    callback(data);
                });
                $('#ball-input').addClass('disabled-section');
                currentModal = type;
                $('#confirmModal').modal('show');
            }

            // Handle modal close
            $('#playerSelectionModal, #batsmanSelectionModal, #bowlerSelectionModal, #wicketModal, #confirmModal').on('hidden.bs.modal', function() {
                if (!currentModal || currentModal === $(this).attr('id')) {
                    $('#ball-input').removeClass('disabled-section');
                    currentModal = null;
                }
                fetchLiveScore(); // Refresh UI
            });

            // Fetch live score and match data
            function fetchLiveScore() {
                showSpinner();
                $.ajax({
                    url: '<?= base_url("cricket/score") ?>',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log('Live Score Data:', data); // Debug
                        $('#match-title').text(data.match_title);
                        $('#current-score').text(data.score + '/' + data.wickets);
                        $('#overs').text('Overs: ' + data.overs);
                        $('#run-rate').text('Run Rate: ' + data.run_rate);
                        $('#striker-name').text(data.striker_name || 'None');
                        $('#non-striker-name').text(data.non_striker_name || 'None');
                        $('#bowler-name').text(data.bowler_name || 'None');
                        $('#bowler-overs').text(data.bowler_overs || '0.0');
                        $('#target-score').toggle(data.innings === 2 && data.target > 0).text('Target: ' + data.target);

                        // Update player selection dropdowns
                        updatePlayerDropdowns(data);

                        // Show/hide player selection
                        if (!data.striker_id || !data.non_striker_id || !data.bowler_id || data.wicket_fallen || data.over_completed) {
                            $('#player-selection').show();
                        } else {
                            $('#player-selection').hide();
                        }

                        // Update match state
                        if (data.match_completed) {
                            $('#match-header').addClass('match-completed').removeClass('match-header');
                            $('#match-status').text('Match Completed');
                            $('#ball-input, #player-selection').addClass('disabled-section');
                        } else if (data.innings === 2) {
                            $('#match-status').text('2nd Innings | Overs: ' + data.overs);
                            if (!data.striker_id || !data.non_striker_id || !data.bowler_id) {
                                playersSelected = false;
                                $('#ball-input').addClass('disabled-section');
                                fetchPlayers('playerSelectionModal');
                                $('#playerSelectionModal').modal('show');
                            } else {
                                playersSelected = true;
                                $('#ball-input').removeClass('disabled-section');
                                if (!data.wicket_fallen && !data.over_completed) {
                                    $('#player-selection').hide();
                                }
                            }
                        } else {
                            $('#match-status').text('1st Innings | Overs: ' + data.overs);
                            if (!data.striker_id || !data.non_striker_id || !data.bowler_id) {
                                playersSelected = false;
                                $('#ball-input').addClass('disabled-section');
                                fetchPlayers('playerSelectionModal');
                                $('#playerSelectionModal').modal('show');
                            } else {
                                playersSelected = true;
                                $('#ball-input').removeClass('disabled-section');
                                if (!data.wicket_fallen && !data.over_completed) {
                                    $('#player-selection').hide();
                                }
                            }
                        }

                        // Check for over change or wicket
                        if (data.over_completed && playersSelected && !currentModal) {
                            fetchPlayers('bowlerSelectionModal');
                            $('#bowlerSelectionModal').modal('show');
                        }
                        if (data.wicket_fallen && playersSelected && !currentModal) {
                            fetchPlayers('batsmanSelectionModal');
                            $('#batsmanSelectionModal').modal('show');
                        }

                        // Update commentary with icons
                        $('#commentary').empty();
                        data.commentary.forEach(function(ball) {
                            let icon = '';
                            if (ball.commentary.includes('run')) icon = '<span class="commentary-icon">🏏</span>';
                            else if (ball.commentary.includes('Out')) icon = '<span class="commentary-icon">❌</span>';
                            else if (ball.commentary.includes('Wide') || ball.commentary.includes('No-Ball') || ball.commentary.includes('Bye')) icon = '<span class="commentary-icon">⚠️</span>';
                            $('#commentary').append(
                                '<div class="ball-commentary">' +
                                '<span class="over-info">' + ball.over + '</span>' +
                                '<span>' + icon + ball.commentary + '</span>' +
                                '</div>'
                            );
                        });

                        hideSpinner();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching live score:', status, error); // Debug
                        hideSpinner();
                        showToast('error', 'Error fetching live score');
                    }
                });
            }

            // Fetch available players
            function fetchPlayers(modalId = null) {
                showSpinner();
                $.ajax({
                    url: '<?= base_url("cricket/players") ?>',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log('Players Data:', data); // Debug
                        if (modalId === 'playerSelectionModal') {
                            $('#modal-striker').empty().append('<option value="">Select Striker</option>');
                            $('#modal-non-striker').empty().append('<option value="">Select Non-Striker</option>');
                            data.batsmen.forEach(function(player) {
                                $('#modal-striker').append(`<option value="${player.id}">${player.name}</option>`);
                                $('#modal-non-striker').append(`<option value="${player.id}">${player.name}</option>`);
                            });
                            $('#modal-bowler').empty().append('<option value="">Select Bowler</option>');
                            data.bowlers.forEach(function(player) {
                                if (player.overs < data.max_overs) {
                                    $('#modal-bowler').append(`<option value="${player.id}">${player.name}</option>`);
                                }
                            });
                        } else if (modalId === 'batsmanSelectionModal') {
                            $('#modal-new-batsman').empty().append('<option value="">Select Batsman</option>');
                            data.batsmen.forEach(function(player) {
                                $('#modal-new-batsman').append(`<option value="${player.id}">${player.name}</option>`);
                            });
                        } else if (modalId === 'bowlerSelectionModal') {
                            $('#modal-new-bowler').empty().append('<option value="">Select Bowler</option>');
                            data.bowlers.forEach(function(player) {
                                if (player.overs < data.max_overs) {
                                    $('#modal-new-bowler').append(`<option value="${player.id}">${player.name}</option>`);
                                }
                            });
                        } else {
                            // Update UI dropdowns
                            $('#striker').empty().append('<option value="">Select Striker</option>');
                            $('#non-striker').empty().append('<option value="">Select Non-Striker</option>');
                            data.batsmen.forEach(function(player) {
                                $('#striker').append(`<option value="${player.id}">${player.name}</option>`);
                                $('#non-striker').append(`<option value="${player.id}">${player.name}</option>`);
                            });
                            $('#bowler').empty().append('<option value="">Select Bowler</option>');
                            data.bowlers.forEach(function(player) {
                                if (player.overs < data.max_overs) {
                                    $('#bowler').append(`<option value="${player.id}">${player.name}</option>`);
                                }
                            });
                        }
                        hideSpinner();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching players:', status, error); // Debug
                        hideSpinner();
                        showToast('error', 'Error fetching players');
                    }
                });
            }

            // Update player dropdowns with current selections
            function updatePlayerDropdowns(data) {
                if (data.striker_id) {
                    $('#striker').val(data.striker_id);
                }
                if (data.non_striker_id) {
                    $('#non-striker').val(data.non_striker_id);
                }
                if (data.bowler_id) {
                    $('#bowler').val(data.bowler_id);
                }
            }

            // Confirm player change from dropdowns
            window.confirmPlayerChange = function(role, playerId) {
                const striker = $('#striker').val();
                const nonStriker = $('#non-striker').val();
                if (role === 'striker' && playerId === nonStriker) {
                    showToast('error', 'Striker and Non-Striker cannot be the same');
                    fetchLiveScore();
                    return;
                }
                if (role === 'non-striker' && playerId === striker) {
                    showToast('error', 'Striker and Non-Striker cannot be the same');
                    fetchLiveScore();
                    return;
                }
                if (playerId) {
                    showConfirmModal('playerChange', { role, playerId }, `Confirm change ${role} to new player?`, function(data) {
                        showSpinner();
                        $.ajax({
                            url: '<?= base_url("cricket/update_player") ?>',
                            method: 'POST',
                            data: { role: data.role, player_id: data.playerId },
                            success: function(response) {
                                showToast('success', `${data.role} updated successfully`);
                                fetchLiveScore();
                            },
                            error: function() {
                                showToast('error', `Error updating ${data.role}`);
                                fetchLiveScore();
                            }
                        });
                    });
                } else {
                    fetchLiveScore(); // Revert dropdown
                }
            }

            // Confirm initial player selection
            window.confirmPlayers = function() {
                const striker = $('#modal-striker').val();
                const nonStriker = $('#modal-non-striker').val();
                const bowler = $('#modal-bowler').val();
                if (striker && nonStriker && bowler) {
                    if (striker === nonStriker) {
                        showToast('error', 'Striker and Non-Striker cannot be the same');
                        return;
                    }
                    showConfirmModal('players', { striker, nonStriker, bowler }, 'Confirm selection: Striker, Non-Striker, and Bowler?', function(data) {
                        showSpinner();
                        $.ajax({
                            url: '<?= base_url("cricket/update_players") ?>',
                            method: 'POST',
                            data: { striker_id: data.striker, non_striker_id: data.nonStriker, bowler_id: data.bowler },
                            success: function(response) {
                                showToast('success', 'Players updated successfully');
                                playersSelected = true;
                                $('#playerSelectionModal').modal('hide');
                                fetchLiveScore();
                            },
                            error: function() {
                                showToast('error', 'Error updating players');
                            }
                        });
                    });
                } else {
                    showToast('error', 'Please select valid striker, non-striker, and bowler');
                }
            }

            // Confirm new batsman
            window.confirmNewBatsman = function() {
                const batsmanId = $('#modal-new-batsman').val();
                if (batsmanId) {
                    showConfirmModal('newBatsman', batsmanId, 'Confirm new batsman selection?', function(playerId) {
                        showSpinner();
                        $.ajax({
                            url: '<?= base_url("cricket/update_player") ?>',
                            method: 'POST',
                            data: { role: 'batsman', player_id: playerId },
                            success: function(response) {
                                showToast('success', 'New batsman updated successfully');
                                $('#batsmanSelectionModal').modal('hide');
                                fetchLiveScore();
                            },
                            error: function() {
                                showToast('error', 'Error updating batsman');
                            }
                        });
                    });
                } else {
                    showToast('error', 'Please select a batsman');
                }
            }

            // Confirm new bowler
            window.confirmNewBowler = function() {
                const bowlerId = $('#modal-new-bowler').val();
                if (bowlerId) {
                    showConfirmModal('newBowler', bowlerId, 'Confirm new bowler selection?', function(playerId) {
                        showSpinner();
                        $.ajax({
                            url: '<?= base_url("cricket/update_player") ?>',
                            method: 'POST',
                            data: { role: 'bowler', player_id: playerId },
                            success: function(response) {
                                showToast('success', 'New bowler updated successfully');
                                $('#bowlerSelectionModal').modal('hide');
                                fetchLiveScore();
                            },
                            error: function() {
                                showToast('error', 'Error updating bowler');
                            }
                        });
                    });
                } else {
                    showToast('error', 'Please select a bowler');
                }
            }

            // Confirm ball outcome
            window.confirmBall = function(type, value) {
                if (!playersSelected) return;
                let message = '';
                if (type === 'runs') {
                    message = `Confirm ${value} run${value !== 1 ? 's' : ''}?`;
                } else if (type === 'extra') {
                    message = `Confirm ${value} extra?`;
                }
                showConfirmModal('ball', { type, value }, message, function(data) {
                    recordBall(data.type, data.value);
                });
            }

            // Record ball outcome
            window.recordBall = function(type, value) {
                showSpinner();
                $.ajax({
                    url: '<?= base_url("cricket/record_ball") ?>',
                    method: 'POST',
                    data: { type: type, value: value },
                    success: function(response) {
                        showToast('success', 'Ball recorded successfully');
                        fetchLiveScore();
                    },
                    error: function() {
                        showToast('error', 'Error recording ball');
                    }
                });
            }

            // Toggle run-out options in wicket modal
            window.toggleRunOutOptions = function() {
                const dismissalType = $('#dismissal-type').val();
                $('#run-out-options').toggle(dismissalType === 'run-out');
            }

            // Confirm wicket with dismissal type and run-out player
            window.confirmWicket = function() {
                const dismissalType = $('#dismissal-type').val();
                let value = dismissalType;
                if (dismissalType === 'run-out') {
                    value = dismissalType + '|' + $('#run-out-player').val();
                }
                showConfirmModal('wicket', value, `Confirm wicket: ${dismissalType}?`, function(wicketValue) {
                    recordBall('wicket', wicketValue);
                    $('#wicketModal').modal('hide');
                });
            }

            // Undo last ball
            window.undoLastBall = function() {
                showSpinner();
                $.ajax({
                    url: '<?= base_url("cricket/undo_ball") ?>',
                    method: 'POST',
                    success: function(response) {
                        showToast('success', 'Last ball undone successfully');
                        fetchLiveScore();
                        fetchPlayers();
                    },
                    error: function() {
                        showToast('error', 'Error undoing last ball');
                    }
                });
            }

            // Initialize modals and fetch data
            fetchLiveScore();
            fetchPlayers();
        });
    </script>
</body>
</html>