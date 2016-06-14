        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forgot Password ?</h4>
            </div>
            <div class="modal-body">
                <p>Enter your e-mail address below to reset your password.</p>
                {!! Form::open(['url' => 'password/reset']) !!}
                <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                {{-- <button class="btn btn-primary" type="button">Submit</button> --}}
                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            </div>
            {!! Form::close() !!}
        </div>