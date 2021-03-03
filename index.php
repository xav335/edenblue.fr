
<!doctype html>
<html class="no-js" lang="fr">
  <head>
    <?php include 'inc/inc.head.php'; ?>
    <title>Eden Blue</title>
  </head>
<body>

  <?php include 'inc/inc.header.php'; ?>

  <main class="grid-container">

    <section class="grid-x grid-padding-x" data-role="introduction">
      <div class="large-12 cell">
        <h1 data-animation="top">Constructeur de piscine</h1>
        <p data-animation="top">
          <strong>Eden Blue</strong>, constructeur de piscine en béton armé monobloc, en Aquitaine.<br/>
          Nous intervenons dans toute la Gironde (Bassin d’Arcachon, Bordeaux, Libourne,  Blaye, Médoc…) et dans les départements limitrophes (Dordogne, Charente, Landes et Lot et Garonne)
        </p>
      </div>
    </section>

    <section class="grid-x grid-padding-x" data-role="votre-projet">
      <div class="large-5 medium-5 small-12 cell">
        <img src="assets/img/enfant-brassards.svg" alt="enfant brassards">
        <img src="assets/img/nageuse.svg" alt="nageuse">
        <img src="assets/img/bubbles.svg" alt="bulles">
      </div>
      <div class="large-7 medium-7 small-12 cell">
        <img src="assets/img/bubbles.svg" alt="bulles">
        <form class="grid-x grid-padding-x" data-animation="top">
          <div class="large-12 medium-12 small-12 cell">
            <h2>Parlons de votre projet</h2>
          </div>
          <div class="large-6 medium-6 small-12 cell">
            <input type="text" name="nom" placeholder="Nom" /><input type="text" name="prenom" placeholder="Prénom" />
            <input type="text" name="cp" placeholder="Code postal" /><input type="text" name="ville" placeholder="Ville" />
            <input type="tel" name="telephone" placeholder="Téléphone" />
            <input type="email" name="email" placeholder="e-mail" />
          </div>
          <div class="large-6 medium-6 small-12 cell">
            <textarea name="message" placeholder="Votre projet en quelques mots"></textarea>
          </div>
          <div class="large-6 medium-6 small-12 cell"></div>
          <div class="large-6 medium-6 small-12 cell">
            <input type="submit" value="Être rappelé(e)">
          </div>
        </form>
      </div>
      <div class="large-12 medium-12 small-12 cell">
        <div data-animation="right"><a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a> <a href="tel:+33533880011">05 33 88 00 11</a></div>
      </div>
    </section>

    <section class="grid-x grid-padding-x" data-role="partenaire-reconnu">
      <div class="large-12 cell">
        <h2 data-animation="top">Un partenaire reconnu</h2>
        <p data-animation="top">
          La société <strong>Eden Blue</strong> est un partenaire privilégié du groupe Leader Pool professionnel de la piscine en béton armé depuis plus de 15 ans et avec plus de 7000 réalisations au niveau national et Européen.<br/>
          <strong>Eden Blue</strong> est une marque déposée depuis 2004 et utilise le procédé Leader Pool unique, breveté et agréé SOCOTEC pour la construction des piscines haut de gamme s’intégrant parfaitement à leur environnement.
        </p>
      </div>
    </section>

    <section class="grid-x grid-padding-x" data-role="actualites">
      <div class="large-12 cell">
        <h2 data-animation="top">Nouvelles fraiches</h2>
        <div>
          <figure data-animation="right">
            <img src="assets/img/piscine-interieure.jpg" alt="piscine intérieure">
            <input type="checkbox" name="actu" id="actu-1">
            <figcaption>
              <label for="actu-1">+</label>
              <div>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam facilisis volutpat dolor, finibus imperdiet dolor consequat rhoncus. Integer eget odio nunc. Suspendisse quis est ante...<br/>
                <a href="#">Lire la suite</a>
              </div>
            </figcaption>
          </figure>
          <figure data-animation="left">
            <img src="assets/img/piscine-interieure.jpg" alt="piscine intérieure">
            <input type="checkbox" name="actu" id="actu-2">
            <figcaption>
              <label for="actu-2">+</label>
              <div>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam facilisis volutpat dolor, finibus imperdiet dolor consequat rhoncus. Integer eget odio nunc. Suspendisse quis est ante...<br/>
                <a href="#">Lire la suite</a>
              </div>
            </figcaption>
          </figure>
        </div>
      </div>
      <div class="large-12 cell"><a href="" class="button">+ d’actualités</a></div>
    </section>

  </main>

  <?php include 'inc/inc.footer.php'; ?>

</body>
</html>
