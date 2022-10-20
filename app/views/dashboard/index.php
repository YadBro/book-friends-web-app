<div class="container-fluid px-4">
  <div class="row g-3 my-2">
    <div class="col-md-3">
      <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
        <div>
          <h3 class="fs-2"><?= $data['friendsMaleGender']->num_rows ?></h3>
          <p class="fs-5">Male</p>
        </div>
        <i class="fas fa-mars fs-1 primary-text border rounded-full secondary-bg p-3"></i>
      </div>
    </div>

    <div class="col-md-3">
      <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
        <div>
          <h3 class="fs-2"><?= $data['friendsFemaleGender']->num_rows ?></h3>
          <p class="fs-5">Female</p>
        </div>
        <i class="fas fa-venus fs-1 primary-text border rounded-full secondary-bg p-3"></i>
      </div>
    </div>

  </div>

  <!-- CHART -->
  <div class="my-5 d-flex flex-column">
    <h3 class="fs-4 mb-3">Diagrams</h3>
    <button id="report" class="btn btn-primary float-right align-self-end mb-3" disabled onclick="generatePDF()">Export to PDF</button>
    <canvas id="genderDiagram" width="100" height="50" class=" bg-white shadow-sm p-3 rounded" data-genderMaleAge="<?= $data['countMaleUnder19'] . "," . $data['countMaleAbove20']; ?>" data-genderFemaleAge="<?= $data['countFemaleUnder19'] . "," . $data['countFemaleAbove20']; ?>"></canvas>
  </div>

  <?php if ($data['friends']->num_rows === 0) : ?>
    <div class="my-5">
      <h3 class="fs-4 mb-3">My Friends</h3>
      <div class="bg-white shadow-sm p-3 rounded">
        <h5>You have no friends ☹. Please add <a href="<?= BASE_URL; ?>dashboard/add_friend">here</a></h5>
      </div>
    </div>
  <?php else : ?>
    <!-- TABLES -->
    <div class="row my-5">
      <h3 class="fs-4 mb-3">My Friends</h3>
      <div class="col">
        <table class="table bg-white rounded shadow-sm table-hover">
          <thead>
            <tr>
              <th scope="col" width="50">#</th>
              <th scope="col">Name</th>
              <th scope="col">Age</th>
              <th scope="col">Gender</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($data['friends'] as $friend) : ?>
              <tr>
                <th scope="row"><?= $no++ ?></th>
                <td><?= $friend['friend_name'] ?></td>
                <td><?= $friend['age'] ?></td>
                <td><?= $friend['gender'] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php endif; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script>

<script>
  const friendsData = <?php
                      $test = [];
                      foreach ($data['friends'] as $friend) {
                        array_push($test, $friend);
                      }
                      echo json_encode($test);
                      ?>;
  const genderMaleDiagram = document.getElementById('genderDiagram').dataset.gendermaleage.split(',');
  let Male_Under_19 = genderMaleDiagram[0];
  let Male_Above_20 = genderMaleDiagram[1];

  const genderFemaleDiagram = document.getElementById('genderDiagram').dataset.genderfemaleage.split(',');
  let Female_Under_19 = genderFemaleDiagram[0];
  let Female_Above_20 = genderFemaleDiagram[1];

  const ctx = document.getElementById('genderDiagram').getContext('2d');
  let imageChart = '';
  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Male Under 19', 'Male Above 20', 'Female Under 19', 'Female Above 20'],
      datasets: [{
        data: [Male_Under_19, Male_Above_20, Female_Under_19, Female_Above_20],
        backgroundColor: [
          'rgb(146, 187, 209)',
          'rgb(89, 142, 171)',
          'rgb(191, 132, 180)',
          'rgb(148, 77, 134)',
        ],
        borderColor: [
          'rgb(146, 187, 209)',
          'rgb(89, 142, 171)',
          'rgb(191, 132, 180)',
          'rgb(148, 77, 134)',
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        }
      },
      plugins: {
        legend: {
          display: false,
        }
      },
      animation: {
        onComplete: function(animation) {
          // Check if animation and data are loaded!
          if (animation) {
            document.getElementById('report').disabled = false;
          }
          imageChart = myChart.toBase64Image();
        }
      }
    }
  });

  function downloadImage() {
    let link = document.createElement('a');
    link.download = 'report-chart.png';
    link.href = myChart.toBase64Image();
    link.click();
  }


  function generatePDF() {
    function createHeaders(keys) {
      var result = [];
      for (var i = 0; i < keys.length; i += 1) {
        result.push({
          id: keys[i],
          name: keys[i],
          prompt: keys[i],
          width: 65,
          align: "center",
          padding: 0
        });
      }
      return result;
    }
    var headers = createHeaders([
      "friend_name",
      "age",
      "gender",
    ]);
    var pdfObject = new jsPDFInvoiceTemplate.jsPDF();
    pdfObject.setFontSize(40);
    pdfObject.text("Book Friends Report", 35, 25);
    pdfObject.addImage(imageChart, "PNG", 15, 40, 180, 70);
    pdfObject.table(20, 140, friendsData, headers, {
      padding: 5,
    });
    pdfObject.save();
  }
</script>