//
//  FirstViewController.h
//  iQRContact
//
//  Created by Crystal Hansen on 11-08-02.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>


@interface FirstViewController : UIViewController <ZBarReaderDelegate>  {
	
    UIImageView *resultImage;
    UITextView *resultText;
}
@property (nonatomic, retain) IBOutlet UIImageView *resultImage;
@property (nonatomic, retain) IBOutlet UITextView *resultText;
- (IBAction) scanButtonTapped;
-(void)displaySourceError;

@end
