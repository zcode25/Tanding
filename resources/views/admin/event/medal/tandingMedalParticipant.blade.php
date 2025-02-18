@extends('layouts.adminEvent')

@section('container')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1 class="mb-2">Bagan Pertandingan</h1>
                    <p>{{ $bracket->competition->category->category_name }} / {{ $bracket->competition->age->age_name }} / {{ $bracket->competition->gender }} / {{ $bracket->matchclass->class_name }} ({{ $bracket->matchclass->class_min }}Kg s/d {{ $bracket->matchclass->class_max }}Kg)</p>
                    {{-- <p>{{ $category->category_name }} / {{ $age->age_name }} / {{ $competition->gender }} / {{ $matchclass->class_name }} ({{ $matchclass->class_min }}Kg s/d {{ $matchclass->class_max }}Kg)</p> --}}
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Bagan Pertandingan</h3>
              </div>
              <div class="card-body">
                  <div id="bracket-container" class="bracket-container"></div> <!-- Bracket akan muncul di sini -->
              </div>
            </div>
          </div>
        </div>
        <div class="row">

            <div class="col-xl-12">
              
              <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Bagan Pertandingan</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Pool</th>
                                <th>Nomor Partai</th>
                                <th>Ronde</th>
                                <th>Peserta 1</th>
                                <th>Peserta 2</th>
                                <th>Status</th>
                                <th>Pemenang</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($matches as $match)
                          <tr>
                          <form action="/adminBracket/bracket/match/update/{{ $match->match_id }}" method="POST">
                            @csrf
                                @if($match->pool)
                                <td>Pool {{ $match->pool->pool_number }}</td>
                                @else
                                <td class="py-0 align-middle">Full</td>
                                @endif
                                <td>{{ $match->match_number }}</td>
                                <td>{{ $match->round }}</td>
                                @php
                                    $athlete1 = $match->participantOne ? json_decode($match->participantOne->athlete_name, true) : null;
                                    $athlete2 = $match->participantTwo ? json_decode($match->participantTwo->athlete_name, true) : null;
                                @endphp

                                <td>
                                  @php
                                    $athletes = json_decode($match->participantOne->athlete_name, true);
                                  @endphp
                                  {{ is_array($athletes) ? implode(', ', $athletes) : $match->participantOne->athlete_name }} - {{ $match->participantOne->contingent_name }}
                                </td>

                                <td>
                                  @php
                                    $athletes = json_decode($match->participantTwo->athlete_name, true);
                                  @endphp
                                  {{ is_array($athletes) ? implode(', ', $athletes) : $match->participantTwo->athlete_name }} - {{ $match->participantTwo->contingent_name }}
                                </td>
                                <td>
                                  {{ $match->status }}
                                </td>
                                <td>
                                  @php
                                    $athletes = json_decode($match->winner->athlete_name, true);
                                  @endphp
                                  {{ is_array($athletes) ? implode(', ', $athletes) : $match->winner->athlete_name }} - {{ $match->winner->contingent_name }}
                                </td>

                              </form>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            </div>

            
        </div>

        
        <div class="row">
          <div class="col-xl-4">
            <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Bagan Pertandingan</h3>
              </div>
              <form action="/adminMedal/medal/store" method="POST" class="form-horizontal">
                  @csrf
                  <input type="hidden" id="event_id" name="event_id" value="{{ $event->event_id }}">
                  <input type="hidden" id="competition_id" name="competition_id" value="{{ $bracket->competition_id }}">
                  <input type="hidden" id="class_id" name="class_id" value="{{ $bracket->class_id }}">
  
                  <div class="card-body">
  
                      <div class=" form-group">
                        <label for="participant_id" class="form-label">Peserta <span class="text-danger">*</span></label>
                        <select class="form-control select2bs4 @error('participant_id') is-invalid @enderror" id="participant_id" name="participant_id" data-placeholder="Pilih Peserta">
                          <option value=""></option>
                          @foreach ($participants as $participant)
                            @php
                              $athletes = json_decode($participant->athlete_name, true);
                            @endphp
                            @if (old('participant_id') == $participant->participant_id)
                              <option value="{{ $participant->participant_id }}" selected>{{ $participant->draw_number ?? '-' }} - {{ is_array($athletes) ? implode(', ', $athletes) : $participant->athlete_name }} - {{ $participant->contingent_name }}</option>
                            @else
                              <option value="{{ $participant->participant_id }}">{{ $participant->draw_number ?? '-' }} - {{ is_array($athletes) ? implode(', ', $athletes) : $participant->athlete_name }} - {{ $participant->contingent_name }}</option>
                            @endif
                          @endforeach
                        </select>
                        @error('participant_id') 
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
  
                      <div class="form-group">
                        <label for="medal">Medal <span class="text-danger">*</span></label>
                        <select class="form-control select2bs4 @error('medal') is-invalid @enderror" id="medal" name="medal" data-placeholder="Pilih Medali">
                          <option value=""></option>
                          @foreach ($medals as $medal)
                            <option value="{{ $medal['medal'] }}" {{ old('medal') == $medal['medal'] ? 'selected' : '' }}>
                                {{ $medal['medal'] }}
                            </option>
                          @endforeach
                        </select>
                        @error('medal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
  
  
                      <div class="d-grid gap-2">
                          <button type="submit" name="submit" class="btn btn-primary btn-block">Tambah</button>
                      </div>
                  </div>
              </form>
            </div>
          </div>
          <div class="col-xl-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Urutan TGR</h3>
      
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              
              <div class="card-body">
                
                <table id="example1" class="table table-hover">
                  <thead>
                      <tr>
                          <th>No Undian</th>
                          <th>Atlet</th>
                          <th>Kontingen</th>
                          <th>Mendali</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($medaltandings as $index => $medaltanding)
                          <tr>
                            <td class="text-center">
                              {{ $medaltanding->participant->draw_number ?? '-' }}
                            </td>
                            <td>
                                @php
                                    $athletes = json_decode($medaltanding->participant->athlete_name, true);
                                @endphp
                                @if (is_array($athletes))
                                    {{ implode(', ', $athletes) }}
                                @else
                                    {{ $medaltanding->participant->athlete_name }}
                                @endif
                            </td>
                            <td>{{ $medaltanding->participant->contingent_name }}</td>
                            <td>{{ $medaltanding->medal }}</td>
                            
                            <td class="py-0 align-middle">
                              <a href="/adminMedal/medal/destroy/{{ $medaltanding->medal_id }}" class="btn btn-danger btn-sm" data-confirm-delete="true">Hapus<i class="fa fa-trash ml-2" aria-hidden="true"></i></a>
                            </td>
                          </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const formatSelect = document.getElementById("format");
        const poolGroup = document.getElementById("pool-group");

        function togglePoolInput() {
            poolGroup.style.display = formatSelect.value === "Pool" ? "block" : "none";
        }

        togglePoolInput();
        formatSelect.addEventListener("change", togglePoolInput);
    });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
      let bracketMatches = @json($matches);
  
      let groupedMatches = {};
      bracketMatches.forEach(match => {
          let poolId = match.pool_id || "Full";
          if (!groupedMatches[poolId]) {
              groupedMatches[poolId] = [];
          }
          groupedMatches[poolId].push(match);
      });
  
      function generateBracket(matches) {
          const rounds = [];
          let roundGroups = {};
  
          matches.forEach(match => {
              let round = match.round;
              if (!roundGroups[round]) {
                  roundGroups[round] = [];
              }
              roundGroups[round].push(match);
          });
  
          Object.keys(roundGroups).sort((a, b) => a - b).forEach(round => {
              rounds.push({ roundNumber: round, matches: roundGroups[round] });
          });
  
          return rounds;
      }
  
      function sanitizeName(name) {
          if (!name) return "Unknown";

          let cleanedName = name.replace(/[\[\]"]/g, "").trim();

          return cleanedName;
      }
  
      function renderBracket(poolName, rounds) {
          const bracketContainer = document.getElementById("bracket-container");
  
          if (poolName !== "Full") {
              let poolTitle = document.createElement("h3");
              poolTitle.innerText = `Pool ${poolName}`;
              bracketContainer.appendChild(poolTitle);
          } else {
              let poolTitle = document.createElement("h3");
              poolTitle.innerText = `Full`;
              bracketContainer.appendChild(poolTitle);
          }
  
          const bracketWrapper = document.createElement("div");
          bracketWrapper.classList.add("bracket-wrapper");
          bracketWrapper.style.position = "relative";
  
          const bracketDiv = document.createElement("div");
          bracketDiv.classList.add("bracket");
  
          let matchPositions = {};
          let matchElements = {};
  
          rounds.forEach(({ roundNumber, matches }, roundIndex) => {
              const roundDiv = document.createElement("div");
              roundDiv.classList.add("round");
  
              let roundTitle = document.createElement("h4");
              roundTitle.innerText = `Round ${roundNumber}`;
              roundDiv.appendChild(roundTitle);
  
              matches.forEach((match, matchIndex) => {
                  let participant1 = match.participant_one ? sanitizeName(match.participant_one.athlete_name) : "BYE";
                  let contingent1 = match.participant_one ? sanitizeName(match.participant_one.contingent_name) : "BYE";
                  let participant2 = match.participant_two ? sanitizeName(match.participant_two.athlete_name) : "BYE";
                  let contingent2 = match.participant_two ? sanitizeName(match.participant_two.contingent_name) : "BYE";
  
                  let winner = match.winner ? sanitizeName(match.winner.athlete_name) : "TBD";
                  let winnerContingent = match.winner ? sanitizeName(match.winner.contingent_name) : "TBD";
                  let matchNumber = match.match_number;
  
                  const matchDiv = document.createElement("div");
                  matchDiv.classList.add("match");
                  matchDiv.setAttribute("data-match", matchNumber);
  
                  let loser1 = match.winner && participant1 !== winner ? 'loser' : '';
                  let loser2 = match.winner && participant2 !== winner ? 'loser' : '';
  
                  matchDiv.innerHTML = `
                      <div class="match-container">
                          <div class="match-number">Partai ${matchNumber}</div>
                          <div class="match-participant blue ${loser1}"><strong>${participant1}</strong> <span>(${contingent1})</span></div>
                          <div class="vs-text">VS</div>
                          <div class="match-participant red ${loser2}"><strong>${participant2}</strong> <span>(${contingent2})</span></div>
                          <div class="winner">Winner: <strong>${winner}</strong> <span>(${winnerContingent})</span></div>
                      </div>
                  `;
  
                  roundDiv.appendChild(matchDiv);
                  matchElements[matchNumber] = matchDiv;
  
                  [participant1, participant2].forEach(player => {
                      if (!matchPositions[player]) {
                          matchPositions[player] = [];
                      }
                      matchPositions[player].push({ matchDiv, roundIndex, matchIndex });
                  });
              });
  
              bracketDiv.appendChild(roundDiv);
          });
  
          bracketWrapper.appendChild(bracketDiv);
          bracketContainer.appendChild(bracketWrapper);
  
          setTimeout(() => addConnectors(matchPositions, matchElements, bracketWrapper), 100);
      }
  
      function addConnectors(matchPositions, matchElements, bracketWrapper) {
          const svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
          svg.setAttribute("class", "bracket-lines");
          svg.style.position = "absolute";
          svg.style.top = "0";
          svg.style.left = "0";
          svg.style.width = "100%";
          svg.style.height = "100%";
          bracketWrapper.appendChild(svg);
  
          Object.keys(matchPositions).forEach(player => {
              let playerMatches = matchPositions[player];
              if (playerMatches.length > 1) {
                  for (let i = 0; i < playerMatches.length - 1; i++) {
                      let startMatch = playerMatches[i];
                      let endMatch = playerMatches[i + 1];
  
                      let startBox = startMatch.matchDiv.getBoundingClientRect();
                      let endBox = endMatch.matchDiv.getBoundingClientRect();
  
                      if (player === "BYE") continue; 
  
                      let startX = startBox.right - bracketWrapper.getBoundingClientRect().left;
                      let startY = startBox.top + startBox.height / 2 - bracketWrapper.getBoundingClientRect().top;
                      let endX = endBox.left - bracketWrapper.getBoundingClientRect().left;
                      let endY = endBox.top + endBox.height / 2 - bracketWrapper.getBoundingClientRect().top;
  
                      let line = document.createElementNS("http://www.w3.org/2000/svg", "line");
                      line.setAttribute("x1", startX);
                      line.setAttribute("y1", startY);
                      line.setAttribute("x2", endX);
                      line.setAttribute("y2", endY);
                      line.setAttribute("stroke", "grey");
                      line.setAttribute("stroke-width", "2");
                      svg.appendChild(line);

                      function createCircle(cx, cy) {
                          let circle = document.createElementNS("http://www.w3.org/2000/svg", "circle");
                          circle.setAttribute("cx", cx);
                          circle.setAttribute("cy", cy);
                          circle.setAttribute("r", "3");
                          circle.setAttribute("fill", "grey");
                          svg.appendChild(circle);
                      }

                      createCircle(startX, startY);
                      createCircle(endX, endY);
                  }
              }
          });
      }
  
      Object.keys(groupedMatches).forEach(poolId => {
          let bracketRounds = generateBracket(groupedMatches[poolId]);
          renderBracket(poolId, bracketRounds);
      });
  });
</script>
  

{{-- <script>
document.addEventListener("DOMContentLoaded", function () {
    let matches = @json($matches2); // Mengambil data match yang sudah diubah

    let groupedParticipants = {};

    matches.forEach(match => {
        let poolId = match.pool_id || "Full";
        if (!groupedParticipants[poolId]) {
            groupedParticipants[poolId] = [];
        }

        // Debugging: Cek apakah participant_one dan participant_two null atau tidak
        console.log("Match:", match);
        console.log("Participant One:", match.participant_one);
        console.log("Participant Two:", match.participant_two);

        // Pastikan participant_one tidak null sebelum mengakses athlete_name
        if (match.participant_one && match.participant_one.athlete_name) {
            groupedParticipants[poolId].push(match.participant_one.athlete_name);
        }

        // Pastikan participant_two tidak null sebelum mengakses athlete_name
        if (match.participant_two && match.participant_two.athlete_name) {
            groupedParticipants[poolId].push(match.participant_two.athlete_name);
        }
    });


    

    function generateBracket(teams) {
        const rounds = [];
        let currentRound = [];

        for (let i = 0; i < teams.length; i += 2) {
            let team1 = teams[i];
            let team2 = teams[i + 1] || "TBD";
            currentRound.push([team1, team2]);
        }

        rounds.push(currentRound);

        while (currentRound.length > 1) {
            let nextRound = [];
            for (let i = 0; i < currentRound.length; i += 2) {
                nextRound.push(["TBD", "TBD"]);
            }
            rounds.push(nextRound);
            currentRound = nextRound;
        }

        return rounds;
    }

    function renderBracket(poolName, rounds) {
        const bracketContainer = document.getElementById("bracket-container2");

        // Cek apakah container bracket ada
        if (!bracketContainer) {
            console.error("Bracket container tidak ditemukan!");
            return;
        }

        if (poolName !== "full") {
            let poolTitle = document.createElement("h3");
            poolTitle.innerText = `Pool ${poolName}`;
            bracketContainer.appendChild(poolTitle);
        }

        const bracketDiv = document.createElement("div");
        bracketDiv.classList.add("bracket");

        rounds.forEach((round, roundIndex) => {
            const roundDiv = document.createElement("div");
            roundDiv.classList.add("round");

            round.forEach((match, matchIndex) => {
                const matchDiv = document.createElement("div");
                matchDiv.classList.add("match");
                matchDiv.innerHTML = `
                    <div>${match[0]} VS ${match[1]}</div>
                `;

                if (roundIndex > 0) {
                    let connector = document.createElement("div");
                    connector.classList.add("connector");
                    matchDiv.appendChild(connector);
                }

                roundDiv.appendChild(matchDiv);
            });

            bracketDiv.appendChild(roundDiv);
        });

        bracketContainer.appendChild(bracketDiv);
    }

    // Periksa apakah ada pool participants
    Object.keys(groupedParticipants).forEach(poolId => {
        console.log(`Membuat bracket untuk pool: ${poolId}`); // Debug poolId
        let bracketRounds = generateBracket(groupedParticipants[poolId]);
        renderBracket(poolId, bracketRounds);
    });
});

</script> --}}

  
  
  
  
@endsection
