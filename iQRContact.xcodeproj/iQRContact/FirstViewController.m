//
//  FirstViewController.m
//  iQRContact
//
//  Created by Crystal Hansen on 11-08-02.
//  Copyright 2011 __blueBug__nCapsule. All rights reserved.
//

#import "FirstViewController.h"
#import "vCard.h"
#import "Person.h"


@implementation FirstViewController
@synthesize resultImage, resultText;

// Implement viewDidLoad to do additional setup after loading the view, typically from a nib.
- (void)viewDidLoad
{
    [super viewDidLoad];
    /*
    if ([line hasPrefix:@"BEGIN"]) {
        personRecord = ABPersonCreate();
    } else if ([line hasPrefix:@"END"]) {
        ABAddressBookAddRecord(addressBook,personRecord, NULL);
    } */
    
    
    
    //READER PARTS
	//create Reader
	ZBarReaderViewController *reader = [ZBarReaderViewController new];
	
	//Setup a delegate to recieve results
	reader.readerDelegate = self;
	
	
	//Configure the Reader
	[reader.scanner setSymbology: ZBAR_QRCODE
						  config: ZBAR_CFG_ENABLE
							  to: 0];
	reader.readerView.zoom = 1.0;
	//Present to the Reader to User
	// present and release the controller
    //[self presentModalViewController: reader
    //	animated: YES];
    
     [reader release];
    
	
}


- (void) imagePickerController: (UIImagePickerController*) reader
 didFinishPickingMediaWithInfo: (NSDictionary*) info
{    // ADD: get the decode results
    id<NSFastEnumeration> results =
	[info objectForKey: ZBarReaderControllerResults];
    ZBarSymbol *symbol = nil;
    
    vCard *importer = [[vCard alloc] init];
    
    for(symbol in results)
        // EXAMPLE: just grab the first barcode
        break;
	
    NSString *lines = symbol.data;
    
    resultText.text = lines;
    [importer parse:lines];
    Person *newPerson = [[Person alloc]init];
    // EXAMPLE: do something useful with the barcode image
    resultImage.image =
	[info objectForKey: UIImagePickerControllerOriginalImage];
	
    // ADD: dismiss the controller (NB dismiss from the *reader*!)
    [reader dismissModalViewControllerAnimated: YES];
    [importer release];
    
}


- (IBAction) scanButtonTapped
{
    // ADD: present a barcode reader that scans from the camera feed
    ZBarReaderViewController *reader = [ZBarReaderViewController new];
    reader.readerDelegate = self;
	
    ZBarImageScanner *scanner = reader.scanner;
    // TODO: (optional) additional reader configuration here
	
    // EXAMPLE: disable rarely used I2/5 to improve performance
    [scanner setSymbology: ZBAR_I25
				   config: ZBAR_CFG_ENABLE
					   to: 0];
	
    // present and release the controller
    [self presentModalViewController: reader animated: YES];
    [reader release];
}

-(void)displaySourceError{
	
	UIAlertView *myAlert = [[UIAlertView alloc] initWithTitle:@"Error:"
													  message:@"Image source not available"
													 delegate:nil
											cancelButtonTitle:@"OK"
											otherButtonTitles:nil];
	[myAlert show];
	[myAlert release];
	
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}


- (void)didReceiveMemoryWarning
{
    // Releases the view if it doesn't have a superview.
    [super didReceiveMemoryWarning];
    
    // Release any cached data, images, etc. that aren't in use.
}


- (void)viewDidUnload
{
    [super viewDidUnload];

    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}


- (void)dealloc
{ 
    self.resultImage = nil;
    self.resultText = nil;
    [super dealloc];
}

@end
