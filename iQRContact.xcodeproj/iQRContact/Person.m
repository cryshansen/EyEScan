//
//  Person.m
//  iQRContact
//
//  Created by Crystal Hansen on 11-08-10.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "Person.h"
#import "vCard.h"


@implementation Person




- (id) init {
    if (self == [super init]) {
        newPerson = [[vCard alloc]init];
    }
    
    return self;
}



/*
 - (ABRecordRef)personRecord {     
 return self->person_; 
 }  
 - (void)setPersonRecord:(ABRecordRef)personRecord:newValue {     
 if (newValue != self->person_) {         
 if (self->person_ != NULL) {             
 CFRelease(self->person_);         
 }         
 self->person_ = newValue;         
 if (self->person_ != NULL) {             
 CFRetain(self->person_);         
 }     
 } 
 } 
 */

-(void)createPersonRecord{
 
        
        ABRecordRef person = ABPersonCreate();
        CFErrorRef error = NULL;
        
        ABRecordSetValue(person, kABPersonFirstNameProperty, newPerson.firstName, &error);
        ABRecordSetValue(person,kABPersonLastNameProperty, newPerson.lastName,&error);
        ABRecordSetValue(person,kABPersonJobTitleProperty,newPerson.title,NULL);
        ABRecordSetValue(person, kABPersonOrganizationProperty,newPerson.Org, nil); 
        ABRecordSetValue(person, kABPersonNicknameProperty,newPerson.nickname, nil);
    
    
    
    if(newPerson.multiPhones != NULL){
    
        ABMultiValueRef phoneRef = ABMultiValueCreateMutable( kABMultiStringPropertyType);
        int size = sizeof(newPerson.multiPhones);
        for (int i=0; i<size; i++) {
            
            
            ABMultiValueAddValueAndLabel(phoneRef,[newPerson.multiPhones objectAtIndex:i],(CFStringRef)[newPerson.phoneLabel objectAtIndex:i],NULL);
        
//kABPersonPhoneMainLabel,NULL);        
// ABMultiValueAddValueAndLabel(phoneRef,@"555-123-4567",kABPersonPhoneMobileLabel,NULL);
            ABRecordSetValue(person,kABPersonPhoneProperty,phoneRef,&error);
        }
        CFRelease(phoneRef);

    }
    if (newPerson.addressDictionary !=NULL) {
        
       
        ABMutableMultiValueRef addressRef = ABMultiValueCreateMutable(kABMultiDictionaryPropertyType);
        NSMutableDictionary *dict = [[NSMutableDictionary alloc] init]; 
        int size = sizeof(newPerson.addressDictionary);
        for (int i=0; i<size; i++) {
        
            for (id key in newPerson.addressDictionary)
            {
                id value = [newPerson.addressDictionary objectForKey:key];
                if (key == @"Street") {
                    
                    [dict setObject:value forKey:(NSString *)kABPersonAddressStreetKey];  
                }else if(key ==@"City"){
                
                    [dict setObject:value forKey:(NSString *)kABPersonAddressCityKey];  

                }else if(key ==@"ZIP"){
                    [dict setObject:value forKey:(NSString *)kABPersonAddressZIPKey];  

                }else if(key == @"Country"){
                
                    [dict setObject:value forKey:(NSString *)kABPersonAddressCountryKey]; 
                }else if(key ==@"label"){
                    
                    ABMultiValueAddValueAndLabel(addressRef, dict, (CFStringRef)[newPerson.addressLabel objectAtIndex:i], NULL); 
                }

            }
            
        }
        
        [dict release];
        
        
        ABRecordSetValue(person, kABPersonAddressProperty, addressRef, nil);  
        CFRelease(addressRef);
    }
   
    if(newPerson.multiEmails != NULL){
        
        ABMultiValueRef emailRef = ABMultiValueCreateMutable( kABMultiStringPropertyType);
        int size = sizeof(newPerson.multiEmails);
        for (int i=0; i < size; i++) {
            
            
            ABMultiValueAddValueAndLabel(emailRef,[newPerson.multiEmails objectAtIndex:i],(CFStringRef)[newPerson.emailLabel objectAtIndex:i],NULL);
            
            
        }
        ABRecordSetValue(person,kABPersonEmailProperty,emailRef,&error);
        CFRelease(emailRef);
        
    }
    
    if(newPerson.multiUrls != NULL){
        ABMultiValueRef immutableMultiUrl = ABRecordCopyValue(person,kABPersonURLProperty);
        ABMultiValueRef urlRef = ABMultiValueCreateMutable( kABMultiStringPropertyType);
         if (immutableMultiUrl) {
             urlRef=ABMultiValueCreateMutableCopy(immutableMultiUrl);
         } else {
           urlRef= ABMultiValueCreateMutable(kABMultiStringPropertyType);
         }
        
        
        int size = sizeof(newPerson.multiUrls);
        for (int i=0; i < size; i++) { 
            ABMultiValueAddValueAndLabel(urlRef,[newPerson.multiUrls objectAtIndex:i],(CFStringRef)[newPerson.urlLabel objectAtIndex:i],NULL);
        }

     //ABMultiValueAddValueAndLabel(newPerson.multiUrls, urlfix,label, NULL);
         ABRecordSetValue(person, kABPersonURLProperty,urlRef,nil);
         if (urlRef != NULL){
             CFRelease(urlRef);
         }
         if (immutableMultiUrl != NULL) {
             CFRelease(immutableMultiUrl);
         }
    }
    
     if(newPerson.photoUrl != NULL){
         
         CFErrorRef cfError = NULL;
         
        CFDataRef dr = CFDataCreate(NULL, [newPerson.dataRef bytes], [newPerson.dataRef length]);
        ABPersonSetImageData(person, dr, &cfError);
        if(dr != NULL){
            CFRelease(dr);
     
    }
}
            
        
    
        ABAddressBookRef addressBook = ABAddressBookCreate();
        ABAddressBookAddRecord(addressBook,person,&error);
        ABAddressBookSave(addressBook,&error);
        
        if (error !=NULL) {
            NSLog(@"error: %@",error);
        }
        
        CFRelease(person);
        CFRelease(addressBook);
   
    
}

- (void)dealloc {
    [newPerson release];
    [super dealloc];
}


@end
