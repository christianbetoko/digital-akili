<div class="footer-newsletter">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-6">
                <h4>Joindre notre newsletter</h4>
                <p>Abonnez-vous à notre newsletter et recevez les dernières nouvelles sur nos produits et services!</p>
                
                <form wire:submit.prevent="submitForm" class="php-email-form">
                    <div class="newsletter-form">
                        <input type="email" wire:model="email" placeholder="Votre email...">
                        {{-- <input type="submit" value="Subscribe"> --}}
                        
                    </div>
<button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>S'abonner</span>
                        <span wire:loading><i class="fa fa-spinner fa-spin"></i> Envoi en cours...</span>
                    </button>
                    <!-- Affichage des erreurs de validation -->
                    @error('email') 
                        <div class="text-danger mt-2" style="display: block;">{{ $message }}</div> 
                    @enderror

                  
                    
                </form>
            </div>
        </div>
    </div>
</div>