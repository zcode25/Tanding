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
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/adminBracket/bracket/match/store/{{ $bracket->bracket_id }}" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-xl-6">
                      @if ($bracket->format === 'Pool')
                        <div class="form-group">
                            <label for="pool_id" class="form-label">Pool <span class="text-danger">*</span></label>
                            <select class="form-control select2bs4 @error('pool_id') is-invalid @enderror" id="pool_id2" name="pool_id" data-placeholder="Pilih Pool">
                              <option value=""></option>    
                                @foreach ($pools as $pool)
                                    <option value="{{ $pool->pool_id }}">Pool {{ $pool->pool_number }}</option>
                                @endforeach
                            </select>
                            @error('pool_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                      @endif

                      <div class="form-group">
                        <label for="match_number" class="form-label">Nomor Partai <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('match_number') is-invalid @enderror" id="match_number" name="match_number" value="{{ old('match_number') }}">
                        @error('match_number') 
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="round" class="form-label">Round <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('round') is-invalid @enderror" id="round" name="round" value="{{ old('round') }}">
                        @error('round') 
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>

                    </div>
                    <div class="col-xl-6">
                      <div class=" form-group">
                        <label for="participant_1" class="form-label">Peserta 1 <span class="text-danger">*</span></label>
                        <select class="form-control select2bs4 @error('participant_1') is-invalid @enderror" id="participant_1" name="participant_1" data-placeholder="Pilih Peserta">
                          <option value=""></option>
                          <option value="BYE">BYE (Tanpa Lawan)</option>       
                          @foreach ($participants as $participant)
                            @php
                              $athletes = json_decode($participant->athlete_name, true);
                            @endphp
                            @if (old('participant_1') == $participant->participant_id)
                              <option value="{{ $participant->participant_id }}" selected>{{ $participant->draw_number ?? '-' }} - {{ is_array($athletes) ? implode(', ', $athletes) : $participant->athlete_name }} - {{ $participant->contingent_name }}</option>
                            @else
                              <option value="{{ $participant->participant_id }}">{{ $participant->draw_number ?? '-' }} - {{ is_array($athletes) ? implode(', ', $athletes) : $participant->athlete_name }} - {{ $participant->contingent_name }}</option>
                            @endif
                          @endforeach
                        </select>
                        @error('participant_1') 
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="participant_2" class="form-label">Peserta 2 <span class="text-danger">*</span></label>
                        <select class="form-control select2bs4 @error('participant_2') is-invalid @enderror" id="participant_2" name="participant_2" data-placeholder="Pilih Peserta">
                            <option value=""></option>
                            <option value="BYE">BYE (Tanpa Lawan)</option>        
                            @foreach ($participants as $participant)
                                @php
                                    $athletes = json_decode($participant->athlete_name, true);
                                @endphp
                                <option value="{{ $participant->participant_id }}">
                                    {{ $participant->draw_number ?? '-' }} - 
                                    {{ is_array($athletes) ? implode(', ', $athletes) : $participant->athlete_name }} - 
                                    {{ $participant->contingent_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('participant_2') 
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select class="form-control select2bs4 @error('status') is-invalid @enderror" id="status" name="status" data-placeholder="Pilih Status">
                          <option value=""></option> 
                          @foreach ($types as $type)
                            <option value="{{ $type['type'] }}" {{ old('status') == $type['type'] ? 'selected' : '' }}>
                                {{ $type['type'] }}
                            </option>
                          @endforeach
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary float-right">Simpan</button>
                </div>
                <!-- /.card-footer -->
              </form>
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($matches as $match)
                          <tr>
                          <form action="/adminBracket/bracket/match/update/{{ $match->match_id }}" method="POST">
                            @csrf
                                @if($match->pool)
                                <td>
                                  <select class="form-control @error('pool_id') is-invalid @enderror" id="pool_id" name="pool_id" data-placeholder="Pilih Pool">
                                    {{-- <option value=""></option>     --}}
                                      @foreach ($pools as $pool)
                                        @if (old('pool_id', $match->pool->pool_id) == $pool->pool_id)
                                          <option value="{{ $pool->pool_id }}" selected>Pool {{ $pool->pool_number }}</option>
                                        @else
                                          <option value="{{ $pool->pool_id }}">Pool {{ $pool->pool_number }}</option>
                                        @endif
                                      @endforeach
                                  </select>
                                </td>
                                @else
                                <td class="py-0 align-middle">Full</td>
                                @endif
                                <td><input type="text" class="form-control @error('match_number') is-invalid @enderror" id="match_number" name="match_number" value="{{ old('match_number', $match->match_number) }}" style="width: 80px;"></td>
                                <td><input type="text" class="form-control @error('round') is-invalid @enderror" id="round" name="round" value="{{ old('round', $match->round) }}" style="width: 80px;"></td>
                                @php
                                    $athlete1 = $match->participantOne ? json_decode($match->participantOne->athlete_name, true) : null;
                                    $athlete2 = $match->participantTwo ? json_decode($match->participantTwo->athlete_name, true) : null;
                                @endphp


                                <td>
                                  <select class="form-control @error('participant_1') is-invalid @enderror" id="participant_1" name="participant_1" data-placeholder="Pilih Peserta">
                                    {{-- <option value=""></option> --}}
                                    <option value="BYE">BYE (Tanpa Lawan)</option>       
                                    @foreach ($participants as $participant)
                                      @php
                                        $athletes = json_decode($participant->athlete_name, true);
                                      @endphp
                                      @if (old('participant_1', $match->participant_1) == $participant->participant_id)
                                        <option value="{{ $participant->participant_id }}" selected>{{ is_array($athletes) ? implode(', ', $athletes) : $participant->athlete_name }} - {{ $participant->contingent_name }}</option>
                                      @else
                                        <option value="{{ $participant->participant_id }}">{{ is_array($athletes) ? implode(', ', $athletes) : $participant->athlete_name }} - {{ $participant->contingent_name }}</option>
                                      @endif
                                    @endforeach
                                  </select>
                                </td>

                                <td>
                                  <select class="form-control @error('participant_2') is-invalid @enderror" id="participant_2" name="participant_2" data-placeholder="Pilih Peserta">
                                    {{-- <option value=""></option> --}}
                                    <option value="BYE">BYE (Tanpa Lawan)</option>        
                                    @foreach ($participants as $participant)
                                        @php
                                          $athletes = json_decode($participant->athlete_name, true);
                                        @endphp
                                        @if (old('participant_2', $match->participant_2) == $participant->participant_id)
                                          <option value="{{ $participant->participant_id }}" selected>{{ is_array($athletes) ? implode(', ', $athletes) : $participant->athlete_name }} - {{ $participant->contingent_name }}</option>
                                        @else
                                          <option value="{{ $participant->participant_id }}">{{ is_array($athletes) ? implode(', ', $athletes) : $participant->athlete_name }} - {{ $participant->contingent_name }}</option>
                                        @endif
                                    @endforeach
                                  </select>
                                </td>
                                <td>
                                  <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" data-placeholder="Pilih Status">
                                    {{-- <option value=""></option>  --}}
                                    @foreach ($types as $type)
                                      @if (old('status', $match->status) == $type['type'])
                                      <option value="{{ $type['type'] }}" selected>
                                          {{ $type['type'] }}
                                      </option>
                                      @else
                                      <option value="{{ $type['type'] }}">
                                        {{ $type['type'] }}
                                      </option>
                                      @endif
                                    @endforeach
                                  </select>
                                </td>
                                <td>
                                  <select class="form-control @error('winner') is-invalid @enderror" id="winner" name="winner" data-placeholder="Pilih Pemenang">
                                    <option value="">Belum Ditentukan</option>  
                                    @if ($match->participantOne)
                                      <option value="{{ $match->participantOne->participant_id }}" {{ old('winner', $match->winner_id) == $match->participantOne->participant_id ? 'selected' : '' }}>
                                        {{ is_array($athlete1) ? implode(', ', $athlete1) : $match->participantOne->athlete_name }}  - {{ $match->participantOne->contingent_name }}
                                      </option>
                                    @endif
                                    @if ($match->participantTwo)
                                      <option value="{{ $match->participantTwo->participant_id }}" {{ old('winner', $match->winner_id) == $match->participantTwo->participant_id ? 'selected' : '' }}>
                                        {{ is_array($athlete2) ? implode(', ', $athlete2) : $match->participantTwo->athlete_name }} - {{ $match->participantTwo->contingent_name }}
                                      </option>
                                    @endif
                                  </select>
                                </td>
                                <td class="py-0 align-middle">
                                  <button type="submit" name="submit" class="btn btn-primary btn-sm">Simpan</button>
                                  <a href="/adminBracket/bracket/match/destroy/{{ $match->match_id }}" class="btn btn-danger btn-sm" data-confirm-delete="true">Hapus<i class="fa fa-trash ml-2" aria-hidden="true"></i></a>
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
