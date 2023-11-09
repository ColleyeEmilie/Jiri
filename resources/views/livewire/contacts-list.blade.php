<div class="contact-list" x-data="{
    createmode: false,
    contactname: '',
    }">
    <div>
        <div>
            <label for="contactname">Mes contacts</label>
            <input type="text" id="contactname" wire:model.live="contactname">
        </div>
        @unless($this->contacts->isEmpty())
            <ol>
                @foreach($this->contacts as $contact)
                    <li wire:key="{{ $contact->id }}"><label
                            for="user{{$contact->id}}">{{ $contact->name }}</label><input
                            id="user{{$contact->id}}" type="checkbox"></li>
                @endforeach
            </ol>
        @endunless
        <button x-on:click="createmode = true; contactname=$wire.get('contactname')">Create</button>
    </div>

    <template x-if="createmode">
        <form wire:submit="save">

            <div><label for="newcontactname">New Contact Name</label>
                <input type="text"
                       id="newcontactname"
                       x-model="contactname"
                       wire:model="newcontactname"></div>

            <div><label for="newcontactemail">New Contact Email</label>
                <input type="email"
                       id="newcontactemail"
                       wire:model="newcontactemail"></div>

            <button type="submit" x-on:click="$wire.set('newcontactname',contactname)">Save</button>

        </form>
    </template>
</div>
