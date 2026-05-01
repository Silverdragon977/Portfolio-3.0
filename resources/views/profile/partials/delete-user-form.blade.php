
<section class="mb-6">
    <header>
        <h2 class="h5 font-weight-medium text-dark">
             Delete Account 
        </h2>

        <p class="mt-1 small text-muted">
             Once your account is deleted, all of its resources and data will be permanently deleted. 
             Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletion">
         Delete Account 
    </button>

    <div class="modal fade" id="confirmUserDeletion" tabindex="-1" role="dialog" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmUserDeletionLabel">
                             Are you sure you want to delete your account?
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                             Once your account is deleted, all of its resources and data will be permanently deleted.
                              Please enter your password to confirm you would like to permanently delete your account.
                        </p>

                        <div class="mt-3">
                            <label for="password" class="sr-only">Password</label>
                            <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel </button>
                        <button type="submit" class="btn btn-danger"> Delete Account </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>