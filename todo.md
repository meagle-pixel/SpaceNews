# TODO

## SEO

- `index.html` qui est la première page du site
- `<title>` unique et pertinent pour chaque page (50 à 60 caractères)
- [ ] `<meta name="description" content="...">` Meta description sur chaque page dans `<head>` (15O à 160 caractères)
- [ ] Présence de balises sémantiques HTML5 bien organisées (`<header>`, `<nav>`, `<main>`, `<article>`, `<section>`, `<aside>`, `<footer>`, etc.)
- [ ] Utilisation appropriée des balises de titres (`<h1>`, `<h2>`, `<h3>`, etc.) pour structurer le contenu
- [ ] images
  - [ ] Texte alternatif (`alt=`) descriptif pour toutes les images
  - [ ] Compression des images pour un chargement rapide
- [ ] Liens
  - [ ] Liens internes pertinents entre les pages du site
  - [ ] Liens externes vers des sites de haute autorité
- [ ] Accessibilité
  - [ ] **Contraste** suffisant entre le texte et l'arrière-plan
  - [ ] **Navigation** au clavier possible
  - [ ] Utilisation d'**ARIA roles** et labels si nécessaire
- [ ] **lighthouse** Faire des tests avec lighthouse dans Chrome DevTools pour vérifier les performances SEO
- [ ] `robots.txt`
- [ ] `sitemap.xml`
- utiliser aria-label, pour une icone comme un menu burger


- Code partie create : 
```php

// $_FILES est généré par le formulaire au moment du upload image.
// 1. Vérifier qu'une image a été envoyée
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    
    // 2. Vérifier le type de fichier (sécurité)
    $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
    $file_type = $_FILES['image']['type'];
    
    if (!in_array($file_type, $allowed_types)) {
        $erreurs[] = "Format d'image non autorisé (JPG, PNG, WEBP uniquement)";
    } else {
        
        // 3. Créer un nom unique pour éviter les doublons
        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('article_') . '.' . $extension;
        
        // 4. Définir le chemin de destination
        $upload_path = '../images/' . $filename;
        
        // 5. Créer le dossier s'il n'existe pas
        if (!is_dir('../images/articles')) {
            mkdir('../images/articles', 0755, true);
        }
        
        // 6. Déplacer le fichier uploadé
        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
            $image_path = 'images/articles/' . $filename;  // Chemin à sauvegarder en base
        } else {
            $erreurs[] = "Erreur lors de l'upload de l'image";
        }
    }
    
} else {
    $erreurs[] = "Une image est requise";
}
```