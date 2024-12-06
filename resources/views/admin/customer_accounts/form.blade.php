<div class="row account_div">
    <div class="row">
        <div class="col-md-6">
            <label for="noc-{{ $key }}">NOC</label>
            <input type="text" name="accounts[{{ $key }}][noc]" value="{{ $account->noc ?? null }}"
                id="noc-{{ $key }}" required class="form-control" placeholder="Enter NOC" pattern="[A-Za-z\s]*"
                title="Only letters and spaces are allowed">
            @error('noc')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="account_name-{{ $key }}">Bank Name</label>
            <input type="text" name="accounts[{{ $key }}][account_name]"
                value="{{ $account->account_name ?? null }}" id="account_name-{{ $key }}" required
                class="form-control" placeholder="Enter Bank Name">
            @error('account_name')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="toll_free-{{ $key }}">Toll Free</label>
            <input type="text" name="accounts[{{ $key }}][toll_free]"
                value="{{ $account->toll_free ?? null }}" id="toll_free-{{ $key }}" class="form-control"
                placeholder="Enter Toll Free Number">
            @error('toll_free')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="exp-{{ $key }}">Exp</label>
            <input type="text" name="accounts[{{ $key }}][exp]" value="{{ $account->exp ?? null }}"
                id="exp-{{ $key }}" placeholder="MM/YY" pattern="^(0[1-9]|1[0-2])\\/\\d{2}$" required
                class="form-control" placeholder="Enter Exp">
            @error('exp')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="account_number-{{ $key }}">Card #</label>
            <input type="text" name="accounts[{{ $key }}][account_number]"
                value="{{ $account->account_number ?? null }}" id="account_number-{{ $key }}" required
                class="form-control" pattern="\d{14,16}" placeholder="Enter Card Number" minlength="14" maxlength="16">
            @error('account_number')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="cvv1-{{ $key }}">CVV/CVV (First CVV)</label>
            <input type="text" name="accounts[{{ $key }}][cvv1]" value="{{ $account->cvv1 ?? null }}"
                id="cvv1-{{ $key }}" required class="form-control" pattern="\d{3,4}"
                placeholder="Enter CVV for Card" minlength="3" maxlength="4">
            @error('cvv1')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="cvv2-{{ $key }}">CVV/CVV (Second CVV)</label>
            <input type="text" name="accounts[{{ $key }}][cvv2]" value="{{ $account->cvv2 ?? null }}"
                id="cvv2-{{ $key }}" class="form-control" pattern="\d{3,4}"
                placeholder="Enter Second CVV for Card" minlength="3" maxlength="4">
            @error('cvv2')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="balance-{{ $key }}">Balance</label>
            <input type="text" name="accounts[{{ $key }}][balance]"
                value="{{ $account->balance ?? null }}" id="balance-{{ $key }}" class="form-control"
                placeholder="Enter Balance">
            @error('balance')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="available-{{ $key }}">Available</label>
            <input type="text" name="accounts[{{ $key }}][available]"
                value="{{ $account->available ?? null }}" id="available-{{ $key }}" class="form-control"
                placeholder="Enter Available">
            @error('available')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="lp-{{ $key }}">LP</label>
            <input type="text" name="accounts[{{ $key }}][lp]" value="{{ $account->lp ?? null }}"
                id="lp-{{ $key }}" class="form-control" placeholder="Enter LP">
            @error('lp')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="dp-{{ $key }}">DP</label>
            <input type="text" name="accounts[{{ $key }}][dp]" value="{{ $account->dp ?? null }}"
                id="dp-{{ $key }}" class="form-control" placeholder="Enter DP">
            @error('dp')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="apr-{{ $key }}">APR%</label>
            <input type="text" name="accounts[{{ $key }}][apr]" value="{{ $account->apr ?? null }}"
                id="apr-{{ $key }}" class="form-control" placeholder="Enter APR%">
            @error('apr')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="poa-{{ $key }}">POA</label>
            <select name="accounts[{{ $key }}][poa]" id="poa-{{ $key }}" class="form-control">
                <option value="yes" {{ $account ? ($account->poa == 'yes' ? 'selected' : '') : 'selected' }}>Yes
                </option>
                <option value="no" {{ $account ? ($account->poa == 'no' ? 'selected' : '') : '' }}>No</option>
            </select>
            @error('poa')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>

        {{-- @if ($account->poa ?? null == 'yes') --}}
        <div class="col-md-6">
            <label for="full_name-{{ $key }}">Full Name</label>
            <input type="text" name="accounts[{{ $key }}][full_name]"
                value="{{ $account->full_name ?? null }}" id="full_name-{{ $key }}" class="form-control"
                placeholder="Enter Full Name">
            @error('full_name')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="address-{{ $key }}">Address</label>
            <input type="text" name="accounts[{{ $key }}][address]"
                value="{{ $account->address ?? null }}" id="address-{{ $key }}" class="form-control"
                placeholder="Enter Address">
            @error('address')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="ssn-{{ $key }}">SSN</label>
            <input type="text" name="accounts[{{ $key }}][ssn]" value="{{ $account->ssn ?? null }}"
                id="ssn-{{ $key }}" class="form-control" placeholder="Enter SSN">
            @error('ssn')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="mmm-{{ $key }}">Mmm</label>
            <input type="text" name="accounts[{{ $key }}][mmm]" value="{{ $account->mmm ?? null }}"
                id="mmm-{{ $key }}" class="form-control" placeholder="Enter Mmm">
            @error('mmm')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="dob-{{ $key }}">DOB</label>
            <input type="text" name="accounts[{{ $key }}][dob]" value="{{ $account->dob ?? null }}"
                id="dob-{{ $key }}" class="form-control" placeholder="Enter DOB">
            @error('dob')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="relation-{{ $key }}">Relation</label>
            <input type="text" name="accounts[{{ $key }}][relation]"
                value="{{ $account->relation ?? null }}" id="relation-{{ $key }}" class="form-control"
                placeholder="Enter Relation">
            @error('relation')
                <div class="validation-error"> {{ $message }}</div>
            @enderror
        </div>
        {{-- @endif --}}
    </div>
</div>

@push('scripts')
    <script>
        $(document).on('click', '.add_account', function(e) {
            let customer_id = $(this).data('customer_id');
            alert(customer_id)
        })
    </script>
@endpush
