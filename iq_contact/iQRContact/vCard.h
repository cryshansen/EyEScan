//
//  vCard.h
//  iQRContact
//
//  Created by Crystal Hansen on 11-08-02.
//  Copyright 2011 __nCapsule blueBug__. All rights reserved.
//

#import <Foundation/Foundation.h>


@interface vCard : NSObject {
    
        NSData * dataRef;
        NSString *firstName,*lastName;
        NSString *name;
        NSString *fName;
        NSString *Org;
        NSString *title;
        NSString *nickname;
        NSString *photoUrl;
        NSMutableDictionary *addressDictionary;
        NSMutableArray *addressLabel;
        //multiValue 'arrays'
        NSMutableArray *multiUrls;
        NSMutableArray *multiPhones;
        NSMutableArray *multiEmails;   
        //Reusable holdervars
        NSString *stringOfVariable;
        NSMutableArray *phoneLabel;
        NSMutableArray *urlLabel;
        NSMutableArray *emailLabel;
        NSString *label;
    
        NSArray *upperComponents;
    
}
@property (nonatomic,retain) NSData *dataRef;
@property (nonatomic, retain) NSString *firstName;
@property (nonatomic, retain) NSString *lastName;
@property (nonatomic, retain) NSString *name;
@property (nonatomic, retain) NSString *fName;
@property (nonatomic, retain) NSString *Org;
@property (nonatomic, retain) NSString *title;
@property (nonatomic, retain) NSString *nickname;
@property (nonatomic, retain) NSString *photoUrl;
@property (nonatomic, retain) NSString *stringOfVariable;

@property (nonatomic,retain) NSMutableArray *addressLabel;
@property (nonatomic,retain) NSMutableArray *urlLabel;
@property (nonatomic,retain) NSMutableArray *multiUrls;
@property (nonatomic,retain) NSMutableArray *phoneLabel;
@property (nonatomic,retain) NSMutableArray *multiPhones;
@property (nonatomic,retain) NSMutableArray *multiEmails;
@property  (nonatomic,retain) NSMutableArray *emailLabel;

@property (nonatomic, retain)  NSMutableDictionary *addressDictionary;


- (void)parse:(NSString*)vCardString;
- (void)parseLine:(NSString*)vCardString;
- (void) separateComponents:(NSString *)line;
- (void) separateComponentsSemiColon:(NSString *)line;
- (void) parseLine:(NSString *)line;
- (void) parseName:(NSString *)line;
- (void) parseFName:(NSString*)line;
- (void) parseOrg:(NSString*)line;
- (void) parseTitle:(NSString*)line;
- (void) parseAddress:(NSString *)line;
- (void) parseTel:(NSString *) line;
- (void) parseEmail:(NSString *)line;
- (void) parseURL:(NSString *)line;
- (void) parsePhotoURL:(NSString *)line;



@end
