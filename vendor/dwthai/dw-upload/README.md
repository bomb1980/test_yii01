# DW-Upload
>ใช้เรียนรู้ประกอบสื่อการสอนคลิปวีดีโอชุด Dreamweaver Database โดย DwThai.Com

## Example

This component simplifies file uploading. Assume a file is uploaded with this HTML form:

    <form method="post" enctype="multipart/form-data" action="">
        <input type="file" name="image" value=""/>
        <input type="submit" value="Upload Now !"/>
    </form>

When the HTML form is submitted, the server-side PHP code can upload the file like this:

    <?php
	use DwThai\DwUpload;
	$fileName =  DwUpload::DwUpload($_FILES['image'],'img/',true);
	echo $fileName;
	

## Description
> DwUpload ( File , [Path , Random Filename ] ) : string

**File: string** อาจได้จากตัวแปร $_FILES[..input name...]

**Path: string** (default: img-products) ตำแหน่งเก็บไฟล์เมื่อ upload

**Random Filename**: true/false (default: false) *booleans*

**Return: string** คืนค่ากลับเป็นชื่อไฟล์ที่ upload (File Name) *String filename return*

## How to Install

Create a composer.json file in your project root:

    {
        "require": {
            "dwthai/dw-upload": "*"
        }
    }

Install via composer:

    composer require dwthai/dw-upload

## Author

[DwThai.Com](https://www.dwthai.com)

## Youtube channel

[DwThai.Com Channel](https://www.youtube.com/dwthai)

## License

MIT Public License
