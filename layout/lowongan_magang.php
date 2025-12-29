<style>
  .container-fluid {
    padding: 30px;
    background-color: #f8f9fa;
    min-height: 100vh;
  }
  
  header {
    text-align: center;
    margin-bottom: 30px;
  }

  .job-card {
    background: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    transition: transform 0.2s, box-shadow 0.2s;
  }

  .job-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  }

  .job-card h3 {
    margin-top: 0;
    color: #0056b3;
    font-weight: bold;
  }

  .badge {
    background-color: #e9ecef;
    color: #495057;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.85rem;
  }

  .btn-lamar {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    display: inline-block;
    margin-top: 10px;
  }

  .btn-lamar:hover {
    background-color: #218838;
    color: white;
  }
</style>

<div class="container-fluid">
  <div class="card shadow-sm"> <div class="card-body">
      <header>
        <h1 style="color: #333;">Portal Magang Mahasiswa</h1>
        <p class="text-muted">Temukan peluang karir pertamamu di sini!</p>
      </header>
      
      <div class="card border-0"> <div class="card-body">
          <form action="index.php?page=table_perusahaan" method="POST">
            
            <div class="job-card">
                <h3>UI/UX Designer Intern</h3>
                <p><span class="badge">Remote</span> | PT. Kreatif Digital</p>
                <p class="text-secondary">Membantu tim desain membuat wireframe dan prototype aplikasi mobile.</p>
                <a href="#" class="btn-lamar">Lamar Sekarang</a>
            </div>

            <div class="job-card">
                <h3>Social Media Intern</h3>
                <p><span class="badge">Hybrid</span> | Media Oke Banget</p>
                <p class="text-secondary">Mengelola konten Instagram dan TikTok untuk branding perusahaan.</p>
                <a href="#" class="btn-lamar">Lamar Sekarang</a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>