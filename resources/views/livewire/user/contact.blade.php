<div class="bg-dark-gray">
    <div class="py-5 container" style="min-height: 80vh">
        @if (session()->has('message'))
            <div class="alert alert-success mt-3">
                {{ session('message') }}
            </div>
        @endif
        <div class="p-3 shadow-sm bg-gray-2">
            <form wire:submit.prevent="submit">
                <h1 class="text-center">Contact Us</h1>
                <div class="form-group my-3">
                    <label for="name">Name</label>
                    <input type="text" wire:model="name" class="form-control bg-gray-3" id="name" placeholder="Enter your name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group my-3">
                    <label for="email">Email address</label>
                    <input type="email" wire:model="email" class="form-control bg-gray-3" id="email" placeholder="Enter your email">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group my-3">
                    <label for="subject">Subject</label>
                    <input type="text" wire:model="subject" class="form-control bg-gray-3" id="subject" placeholder="Enter your subject">
                    @error('subject') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group my-3">
                    <label for="message">Message</label>
                    <textarea wire:model="message" class="form-control bg-gray-3" id="message" rows="3" placeholder="Enter your message" style="max-height: 500px"></textarea>
                    @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</div>
