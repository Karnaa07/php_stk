function confirmLogout() {
        Swal.fire({
            title: "Déconnexion",
            text: "Êtes-vous sûr de vouloir vous déconnecter ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Déconnexion",
            cancelButtonText: "Annuler"
        }).then((result) => {
            if (result.isConfirmed) {
                // L'utilisateur a confirmé la déconnexion, effectuez les actions nécessaires
                logout();
            }
        });
    }

    function logout() {
        // Effectuez ici les opérations de déconnexion (par exemple, envoi d'une requête au serveur)
        
        // Après avoir terminé les opérations de déconnexion, affichez un message de confirmation
        Swal.fire({
            title: "Déconnexion réussie",
            text: "Vous avez bien été déconnecté :)",
            icon: "success",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirigez l'utilisateur vers la page de déconnexion
                window.location.href = "/logout";
            }
        });
    }

