<?php
include_once 'Sample_Header.php';

// New Word document
echo date('H:i:s'), " Create new PhpWord object", \EOL;
$phpWord = new \PhpOffice\PhpWord\PhpWord();

// Begin code
$section = $phpWord->addSection();

// Define the TOC font style
$fontStyle = array('spaceAfter' => 60, 'size' => 12);
$fontStyle2 = array('size' => 10);

// Add title styles
$phpWord->addTitleStyle(1, array('size' => 20, 'color' => '333333', 'bold' => true));
$phpWord->addTitleStyle(2, array('size' => 16, 'color' => '666666'));
$phpWord->addTitleStyle(3, array('size' => 14, 'italic' => true));
$phpWord->addTitleStyle(4, array('size' => 12));

// Add text elements
$section->addText('Table of contents 1');
$section->addTextBreak(2);

// Add TOC #1
$toc = $section->addTOC($fontStyle);
$section->addTextBreak(2);

// Filler
$section->addText('Text between TOC');
$section->addTextBreak(2);

// Add TOC #1
$section->addText('Table of contents 2');
$section->addTextBreak(2);
$toc2 = $section->addTOC($fontStyle2);
$toc2->setMinDepth(2);
$toc2->setMaxDepth(3);


// Add Titles
$section->addPageBreak();
$section->addTitle('I am Title 1', 1);
$section->addText('Some text...');
$section->addTextBreak(2);

$section->addTitle('I am a Subtitle of Title 1', 2);
$section->addTextBreak(2);
$section->addText('Some more text...');
$section->addTextBreak(2);

$section->addTitle('Another Title (Title 2)', 1);
$section->addText('Some text...');
$section->addPageBreak();
$section->addTitle('I am Title 3', 1);
$section->addText('And more text...');
$section->addTextBreak(2);
$section->addTitle('I am a Subtitle of Title 3', 2);
$section->addText('Again and again, more text...');
$section->addTitle('Subtitle 3.1.1', 3);
$section->addText('Text');
$section->addTitle('Subtitle 3.1.1.1', 4);
$section->addText('Text');
$section->addTitle('Subtitle 3.1.1.2', 4);
$section->addText('Text');
$section->addTitle('Subtitle 3.1.2', 3);
$section->addText('Text');

echo date('H:i:s'), " Note: Please refresh TOC manually.", \EOL;
// End code

// Save file
$name = basename(__FILE__, '.php');
$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf');
foreach ($writers as $writer => $extension) {
    echo date('H:i:s'), " Write to {$writer} format", \EOL;
    $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, $writer);
    $xmlWriter->save("{$name}.{$extension}");
    rename("{$name}.{$extension}", "results/{$name}.{$extension}");
}

include_once 'Sample_Footer.php';