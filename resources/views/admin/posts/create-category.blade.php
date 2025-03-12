<x-layout>    
    <x-setting heading="Create New Category"> 
        <form method="POST" action="create-category" enctype="multipart/form-data">
            @csrf
            <x-form.input name="category" required/>
            <x-form.button>Publish</x-form.button>
        </form>
    </x-setting>
</x-layout>

