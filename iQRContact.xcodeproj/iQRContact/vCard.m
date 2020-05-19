//
//  vCard.m
//  iQRContact
//
//  Created by Crystal Hansen on 11-08-02.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "vCard.h"


@implementation vCard
@synthesize firstName,lastName,name,fName,Org,title,nickname,stringOfVariable,addressDictionary;
@synthesize urlLabel,phoneLabel,addressLabel,emailLabel;
@synthesize photoUrl,multiUrls,multiEmails,multiPhones;
@synthesize dataRef;

 

-(void) setFirstName:(NSString *) newName{
	firstName = newName;
}

-(NSString *) firstName{
	return firstName;
}

-(void) setLastName:(NSString *) newName{
	lastName = newName;
}

-(NSString *) lastName{
	return lastName;
}


-(void) setName:(NSString *) newName{
	name = newName;
}

-(NSString *) name{
	return name;
}

-(void) setFName:(NSString *) newFName{
	fName = newFName;
}

-(NSString *) fName{
	return fName;
}

-(void) setNickName:(NSString *) newNickName{
	nickname = newNickName;
}

-(NSString *) nickname{
	return nickname;
}

-(void) setOrg:(NSString *) newOrg{
	title = newOrg;
}

-(NSString *) Org{
	return Org;
}

-(void) setTitle:(NSString *) newTitle{
	title = newTitle;
}

-(NSString *) title{
	return title;
}

-(void)setStringOfVariable:(NSString *)newStringOfVar{
    stringOfVariable = newStringOfVar;
}
-(NSString *)stringOfVariable{
    return stringOfVariable;
}

-(void)setPhotoUrl:(NSString *)newStringOfVar{
    photoUrl = newStringOfVar;
}
-(NSString *)photoUrl{
    return photoUrl;
}


- (void)parse:(NSString*)vCardString {

NSArray *lines = [vCardString componentsSeparatedByString:@"\n"];
    for(NSString* line in lines) {
        [self parseLine:line];
    }
}
- (void) parseLine:(NSString *)line {
    
    //check conditions of prefixes
    if ([line hasPrefix:@"N:"]) {
        [self separateComponents:line];
        [self parseName:[upperComponents objectAtIndex:1]];
    }else if ([line hasPrefix:@"FN:"] ){
        [self separateComponents:line];
        [self parseFName:[upperComponents objectAtIndex:1]];
    }else if ([line hasPrefix:@"ORG:"]){ 
        [self separateComponents:line];
        [self parseOrg:[upperComponents objectAtIndex:1]];
    }else if([line hasPrefix:@"TITLE:"]){
        [self separateComponents:line];
        [self parseTitle:[upperComponents objectAtIndex:1]];
    }else if ([line hasPrefix:@"ADR;"]) {
        [self separateComponentsSemiColon:line];
        [self parseAddress:[upperComponents objectAtIndex:1]];
    }else if ([line hasPrefix:@"TEL;"]){
        [self separateComponentsSemiColon:line];
        [self parseTel:[upperComponents objectAtIndex:1]];
    } else if ([line hasPrefix:@"EMAIL;"]) {
        [self separateComponentsSemiColon:line];
        [self parseEmail:[upperComponents objectAtIndex:1]];
    }else if([line hasPrefix:@"URL;"]){
        [self separateComponentsSemiColon:line];
        [self parseURL:[upperComponents objectAtIndex:1]];
    }else if ([line hasPrefix:@"PHOTO;"]){
        [self separateComponentsSemiColon:line];
        [self parsePhotoURL:[upperComponents objectAtIndex:1]];
    }
}

- (void) separateComponents:(NSString *)line{
    upperComponents = [line componentsSeparatedByString:@":"];
}
- (void) separateComponentsSemiColon:(NSString *)line{
    upperComponents = [line componentsSeparatedByString:@";"];
}

- (void) parseName:(NSString *)line {
    NSArray *components = [line componentsSeparatedByString:@";"];
    firstName = [components objectAtIndex:1];
    lastName = [components objectAtIndex:0];
    //[components release];
}
-(void)parseFName:(NSString*)line{
    
    NSArray *fullname = [line componentsSeparatedByString:@" "];
    firstName= [fullname objectAtIndex:0];            
    lastName =[fullname objectAtIndex:1];
    NSLog(@"Equals FN: %@, %@",[fullname objectAtIndex:0],[ fullname objectAtIndex:1]);
    //[fullname release];
}
-(void)parseOrg:(NSString*)line{

    NSLog(@"EqualsORG: %@",line);
    Org = line ;
}
- (void)parseTitle:(NSString*)line{

    NSLog(@"Equals Title: %@, %@",[upperComponents objectAtIndex:0],line);
    title = line ;
}

- (void) parseAddress:(NSString *)line{
    
    //for address only situation
    NSArray *valuePart2colons = [line componentsSeparatedByString:@";;"];
    NSArray *valueParts = [[valuePart2colons objectAtIndex:1] componentsSeparatedByString:@";"];
     
    
    NSLog(@"In Address");
   
    
    [addressDictionary setObject:[valueParts objectAtIndex:0] forKey:(NSString *) @"Street"];
    [addressDictionary setObject:[valueParts objectAtIndex:1] forKey:(NSString *)@"City"];
    [addressDictionary setObject:[valueParts objectAtIndex:2] forKey:(NSString *)@"State"];
    [addressDictionary setObject:[valueParts objectAtIndex:3] forKey:(NSString *)
        @"ZIP"];
    [addressDictionary setObject:[valueParts objectAtIndex:4] forKey:(NSString *)
     @"Country"];
    
    for (id key in addressDictionary) {
        // NSLog(@"key: %@, value: %@", key, [dictionary objectForKey:key]);
        NSLog(@"Equals Address key: %@,Dict: %@",key,[addressDictionary objectForKey:key]);        
    }
    
    if ([line rangeOfString:@"WORK"].location != NSNotFound) {
        
        [addressDictionary setObject:@"Work" forKey:@"label"];
    } else if ([line rangeOfString:@"HOME"].location != NSNotFound) {
        [addressDictionary setObject:@"HOME" forKey:@"label"];

       
    } else {
        [addressDictionary setObject:@"Other" forKey:@"label"];

    }
        
}

- (void) parseTel:(NSString *) line{
    NSLog(@"In Tel");
    NSError *error = NULL;
    //NSString *phoneLabels = [[NSString alloc] init];
    //NSString *phones = [[NSString alloc] init];
    NSArray *KeyValueArray =[line componentsSeparatedByString:@":"]; 
    NSString *keyPart=[KeyValueArray objectAtIndex:0];
    NSString *valuePart=[KeyValueArray objectAtIndex:1];
    //ABMutableMultiValueRef multiPhone;    
     
    
    NSDataDetector *detector = [NSDataDetector dataDetectorWithTypes:NSTextCheckingTypePhoneNumber error:&error];
    NSArray *matches = [detector matchesInString:valuePart
                                         options:0
                                           range:NSMakeRange(0, [valuePart length])];
    
    for (NSTextCheckingResult *match in matches) {
        if ([match resultType] == NSTextCheckingTypePhoneNumber) {
            NSLog(@"In Tel match exists");
            //if match found a phone number find out wht kind of number for labels REMEMBER OBJECT AT INDEX MAY NOT EXIST!
            if([line rangeOfString:@"HOME"].location !=NSNotFound){
                NSLog(@"In Tel Home Label");
                if([line rangeOfString:@"FAX"].location !=NSNotFound){
                    NSLog(@"In Tel Home Fax Label"); 
                    [phoneLabel addObject:@"kABPersonPhoneHomeFAXLabel"];  
                }else{
                    [phoneLabel addObject:@"kABPersonPhoneHomeLabel"];
                    NSLog(@"In Tel Home PHoneLabel");
                }
                
            }else if([keyPart rangeOfString:@"WORK"].location !=NSNotFound){
                NSLog(@"In Tel Work Label");
                
                if([keyPart rangeOfString:@"FAX"].location !=NSNotFound){
                    [phoneLabel addObject:@"kABPersonPhoneWorkFAXLabel"];
                    NSLog(@"In Tel Work Fax Label");
                }else{
                    [phoneLabel addObject:@"kABPersonPhoneWorkLabel"];
                    NSLog(@"In Tel Work Phone Label");
                }
                
            }else if([keyPart rangeOfString:@"CELL"].location !=NSNotFound){
                [phoneLabel addObject: @"kABPersonPhoneMobileLabel"];
                NSLog(@"In Tel Mobile Label");
            }else if([keyPart rangeOfString:@"MAIN"].location !=NSNotFound){
                [phoneLabel addObject:@"kABPersonPhoneMainLabel"];
                NSLog(@"In Tel Main Label");
            }else if([keyPart rangeOfString:@"PAGER"].location !=NSNotFound){
                [phoneLabel addObject:@"kABPersonPhonePagerLabel"];
                NSLog(@"In Tel Page Label");
            }else{
                [phoneLabel addObject:@"kABOtherLabel"];
                NSLog(@"In Tel Other Label");
            }
             [multiPhones addObject:[match phoneNumber]];
            int size = sizeof(multiPhones)-1;
            NSLog(@"object Ph#: %@",[phoneLabel objectAtIndex:size]);
            NSLog(@"valuepart Ph#: %@",valuePart);            
        }
        
        
    }//END FOR MATCH TEL for loop
    //[KeyValueArray release];    
    
}
- (void) parseEmail:(NSString *)line {

        [multiEmails addObject:line];
    NSArray *emailSplit = [line componentsSeparatedByString:@":"];
    if ([line rangeOfString:@"WORK"].location != NSNotFound) {
        [emailLabel addObject:@"kABWorkLabel"];
        [multiEmails addObject:[emailSplit objectAtIndex:1]];
    } else if ([line rangeOfString:@"HOME"].location != NSNotFound) {
        [emailLabel addObject:@"kABHomeLabel"];
        [multiEmails addObject:[emailSplit objectAtIndex:1]];
    } else {
        [emailLabel addObject:@"kABOtherLabel"];
        [multiEmails addObject:[emailSplit objectAtIndex:1]];
    }
    //[emailSplit release];
    
}

- (void) parseURL:(NSString *)line{
    NSError *error = NULL;
    //NSArray *mainComponents = [line componentsSeparatedByString:@":"];
    NSString *urlAddress = line;
    //CFStringRef label;
    //ABMutableMultiValueRef multiUrls;
    
    NSDataDetector *detector = [NSDataDetector dataDetectorWithTypes:NSTextCheckingTypeLink error:&error];
    
    NSArray *matches = [detector matchesInString:urlAddress options:0 range:NSMakeRange(0, [urlAddress length])];
    
    for (NSTextCheckingResult *match in matches) {
        
        if ([match resultType] == NSTextCheckingTypeLink) {
            
            NSURL *url = [match URL];
            [multiUrls addObject:url];
            NSArray *urlName = [[url absoluteString] componentsSeparatedByString:@":"];
            if ([[urlName objectAtIndex:0] rangeOfString:@"HOME"].location != NSNotFound ||[[urlName objectAtIndex:0] rangeOfString:@"Home"].location != NSNotFound) {
                [urlLabel addObject:@"kABPersonHomePageLabel"];
                
            }else if([[urlName objectAtIndex:0] rangeOfString:@"WORK"].location != NSNotFound)
            { 
                 [urlLabel addObject:@"kABWorkLabel"];
            }
            else{
                 [urlLabel addObject:@"kABOtherLabel"];
            }
            
            
        }
    }
    
}
- (void) parsePhotoURL:(NSString *)line{
    NSError *error = NULL;
    //CFDataRef ABPersonCopyImageDataWithFormat (ABRecordRef person,ABPersonImageFormat format);
    //ABPersonSetImageData (personRecord,imageData,error);
    if(([line rangeOfString:@"TYPE=PNG"].location !=NSNotFound || [line rangeOfString:@"TYPE=JPG"].location != NSNotFound) &&([line rangeOfString:@"VALUE=URL"].location !=NSNotFound)){
        NSArray *valueSet = [line componentsSeparatedByString:@":"];
        NSString *urlAddress = [valueSet objectAtIndex:1];
        
        NSDataDetector *detector = [NSDataDetector dataDetectorWithTypes:NSTextCheckingTypeLink error:&error];
        
        NSArray *matches = [detector matchesInString:urlAddress options:0 range:NSMakeRange(0, [urlAddress length])];
        
        for (NSTextCheckingResult *match in matches) {
            
            if ([match resultType] == NSTextCheckingTypeLink) {
                NSURL *url = [match URL];
                UIImage *image = [UIImage imageWithData: [NSData dataWithContentsOfURL:url]];
                
                // Is it PNG or JPG/JPEG?
                // Running the image representation function writes the data from the image to a file
                if([urlAddress rangeOfString: @".png" options: NSCaseInsensitiveSearch].location != NSNotFound)
                {
                    dataRef = UIImagePNGRepresentation(image);
                }
                else if(
                        [urlAddress rangeOfString: @".jpg" options: NSCaseInsensitiveSearch].location != NSNotFound || 
                        [urlAddress rangeOfString: @".jpeg" options: NSCaseInsensitiveSearch].location != NSNotFound
                        )
                {
                    dataRef = (UIImageJPEGRepresentation(image, 1.0f));
                }
                
            }
        }
        
        }
    }






- (void) dealloc {
    [name release];
    [fName release];
    [firstName release];
    [lastName release];
    [Org release];
    [title release];
    [nickname release];
    [stringOfVariable release];
    [addressDictionary release];
    
    
    [addressLabel release];
    [urlLabel release];
    [emailLabel release];
    [phoneLabel release];
    
    [photoUrl release];
    [multiUrls release];
    [multiEmails release ];
    [multiPhones release];  
    [upperComponents release];
     
    [super dealloc];
}

@end
