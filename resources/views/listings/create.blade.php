<x-layouts.main>

    <style>
        .sr-box {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 0; /* Padding handled inside */
            max-width: 700px;
            margin: 20px auto;
        }
        
        .sr-header-bar {
            background-color: #486b40; /* SR Green */
            color: white;
            padding: 8px 15px;
            font-weight: bold;
            font-family: Verdana, sans-serif;
            font-size: 14px;
            border-bottom: 1px solid #333;
        }

        .sr-form-row {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .sr-label {
            font-weight: bold;
            color: #444;
            display: block;
            margin-bottom: 5px;
            font-size: 13px;
        }

        .sr-input {
            border: 1px solid #aaa;
            padding: 5px;
            width: 100%;
            font-family: Arial, sans-serif;
            font-size: 13px;
            border-radius: 0 !important; /* Force square corners */
            background-color: #fcfcfc;
        }
        .sr-input:focus {
            border-color: #486b40;
            outline: none;
            background-color: #fff;
        }

        .sr-btn-primary {
            background: linear-gradient(to bottom, #f9f9f9, #e9e9e9);
            border: 1px solid #999;
            color: #333;
            padding: 5px 15px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 2px;
        }
        .sr-btn-primary:hover {
            background: #ddd;
            border-color: #666;
        }
        
        .sr-note {
            background-color: #ffffcc;
            border: 1px solid #e6db55;
            color: #555;
            font-size: 11px;
            padding: 10px;
            margin: 15px;
        }
    </style>

    <div class="sr-box">
        <div class="sr-header-bar">
            Create New Listing
        </div>

        <div class="sr-note">
            <strong>Security Reminder:</strong> Ensure your image metadata (EXIF) is scrubbed before uploading. Prices are pegged to current exchange rates.
        </div>

        <form method="post" action="{{ route('listing.create') }}" enctype="multipart/form-data">
            @csrf

            <div class="sr-form-row">
                <label for="name" class="sr-label">Item Name</label>
                <input type="text" class="sr-input" id="name" name="name" placeholder="e.g. Blue Sky Crystal 99%">
            </div>

            <div class="sr-form-row">
                <label for="description" class="sr-label">Description / Shipping Info</label>
                <textarea class="sr-input" id="description" name="description" rows="4" style="resize:vertical;"></textarea>
            </div>

            <div class="sr-form-row">
                <label for="category" class="sr-label">Category</label>
                <select class="sr-input" id="category" name="category" style="width: auto;">
                    <option selected disabled>-- Select Category --</option>
                    <option value="drugs">Drugs & Narcotics</option>
                    <option value="electronics">Electronics</option>
                    <option value="apparel">Apparel</option>
                    <option value="food">Food</option>
                    <option value="tools">Tools & Forgeries</option>
                    <option value="miscellaneous">Miscellaneous</option>
                </select>
            </div>

            <div class="sr-form-row">
                <label for="price" class="sr-label">Price (BTC)</label>
                <div style="display: flex; align-items: center;">
                    <span style="background:#eee; border:1px solid #aaa; border-right:none; padding:5px 8px; font-weight:bold;">฿</span>
                    <input type="number" class="sr-input" id="price" name="price" step="0.0001" style="width: 150px;">
                </div>
            </div>

            <div class="sr-form-row">
                <label for="formFile" class="sr-label">Product Image</label>
                <input class="sr-input" type="file" id="formFile" name="image_path" accept="image/*" style="border:none; padding-left:0;">
                <div style="font-size: 10px; color: #888; margin-top: 5px;">Max size: 2MB. JPG/PNG only.</div>
            </div>

            <div class="sr-form-row" style="background-color: #f5f5f5; border-top: 1px solid #ddd; text-align: right;">
                <a href="/" style="font-size: 12px; margin-right: 15px; text-decoration: underline; color: #555;">Cancel</a>
                <button type="submit" class="sr-btn-primary">Post Listing</button>
            </div>

        </form>
    </div>

</x-layouts.main>